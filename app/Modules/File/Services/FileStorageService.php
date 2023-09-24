<?php

namespace App\Modules\File\Services;

use App\Modules\File\Constants\FileConstant;
use App\Exceptions\ECException;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService
{
    private function getImageDirPath(): string
    {
        return config('fileStorage.image_dir_path');
    }

    private function getVideoDirPath(): string
    {
        return config('fileStorage.video_dir_path');
    }

    public function getLocalTempDirAbsolutePath(): string
    {
        $path = storage_path('temp');
        if (!file_exists($path) && !is_dir($path)) {
            mkdir($path, 0755, true);
        }
        return $path;
    }

    private function getFileStorageDiskNameForImage(): string
    {
        return config('fileStorage.file_storage_disk_name');
    }

    private function getFileStorageDiskNameForVideo(): string
    {
        return config('fileStorage.file_storage_disk_name_video');
    }

    private function generateRandomFileName(string $prefix = ''): string
    {
        $timeString = date('YmdHis');
        return $prefix . $timeString . '_' . uniqid();
    }

    private function deleteLocalFile(string $filePath, bool $suppressError = false)
    {
        try {
            Storage::disk('local')->delete($filePath);
        } catch (\Exception $exception) {
            Log::error($exception);
            throw_unless($suppressError, $exception);
        }
    }

    /**
     * @param HttpFile|UploadedFile $file
     * @return array
     */
    public function storeTempFile($file): array
    {
        $fileName = Str::random(32) . uniqid();

        $path = $this->getLocalTempDirAbsolutePath();
        $file->move($path, $fileName);
        return [
            $fileName,
            $path . '/' . $fileName,
        ];
    }

    public function storeImageFromBase64(string $base64, array $config = []): array
    {
        $base64 = str_contains($base64, ',')
        ? explode(',', $base64)[1]
        : $base64;
        $config = array_merge(FileConstant::DEFAULT_CONFIG, $config);
        $base64Decoded = base64_decode($base64, true);
        $f = finfo_open();
        $mimeType = finfo_buffer($f, $base64Decoded, FILEINFO_MIME_TYPE);
        finfo_close($f);
        throw_unless(
            isset(FileConstant::ALLOWED_IMAGE_MIME_TYPES[$mimeType]),
            new ECException('Invalid image format.')
        );
        $extension = FileConstant::ALLOWED_IMAGE_MIME_TYPES[$mimeType];
        $fileName = $this->generateRandomFileName($config['prefix']);
        $tempFileAbsolutePath = $this->getLocalTempDirAbsolutePath() . '/' . $fileName;
        $localStorage = Storage::disk('local');
        $localStorage->put('temp/' . $fileName, $base64Decoded);
        [$width, $height] = getimagesize($tempFileAbsolutePath);
        $sizeInBytes = $localStorage->size('temp/' . $fileName);
        $this->deleteLocalFile($tempFileAbsolutePath, true);
        throw_if(
            $sizeInBytes > $config['maxSizeInBytes'] * 1024,
            new ECException(
                'File size exceeded.',
                ECException::ERROR_CODE_FILE_SIZE_EXCEEDED_WHEN_STORING_IMAGE_FROM_BASE64
            )
        );
        $fileStorage = Storage::disk($this->getFileStorageDiskNameForImage());
        do {
            $fileName = $this->generateRandomFileName($config['prefix']) . "_${width}_${height}.$extension";
            $fullFilePath = $this->getImageDirPath() . '/' . $fileName;
        } while ($fileStorage->exists($fullFilePath));
        $fileStorage->put($fullFilePath, $base64Decoded);
        return [
            'path' => $fullFilePath,
            'fileName' => $fileName,
            'height' => $height,
            'width' => $width,
            'sizeInBytes' => $sizeInBytes,
        ];
    }

    public function getTempFile(string $fileName): ?HttpFile
    {
        $filePath = storage_path('temp/' . $fileName);
        return File::exists($filePath) ? new HttpFile($filePath) : null;
    }

    /**
     * @param HttpFile|UploadedFile $file
     * @param array $config
     * @return string filename
     */
    public function storeImage($file, $config = [])
    {
        $config = array_merge(FileConstant::DEFAULT_CONFIG, $config);
        $fileStorage = Storage::disk($this->getFileStorageDiskNameForImage());
        $prefix = $config['prefix'];
        $path = "{$this->getImageDirPath()}/$prefix";
        [$width, $height] = getimagesize($file);
        if (!$fileStorage->exists($path)) {
            $fileStorage->makeDirectory($path, $mode = 0777, true, true);
            $fileStorage->setVisibility($path, 'public');
        }
        do {
            $fileName = "$prefix/{$this->generateRandomFileName($config['prefix'])}_{$width}_{$height}.{$file->guessExtension()}";
            $fullFilePath = "{$this->getImageDirPath()}$fileName";
        } while ($fileStorage->exists($fullFilePath));
        $originalName = $file->getClientOriginalName();
        if (!Str::endsWith($originalName, ".{$file->guessExtension()}")) {
            $originalName = "{$originalName}.{$file->guessExtension()}";
        }
        $fileStorage->put($fullFilePath, fopen($file->getRealPath(), 'r'), 'public');
        $imagePath = Storage::url($fullFilePath);
        $url = asset($imagePath);
        return [
            'image_name' => $originalName,
            'image_path' => $url,
        ];
    }

    /**
     *
     * @param string $fileUrl
     * @param array $config
     *
     * @return array
     */
    public function storeImageFromUrl($fileUrl, $config = [])
    {
        $config = array_merge(FileConstant::DEFAULT_CONFIG, $config);
        $fileStorage = Storage::disk($this->getFileStorageDiskNameForImage());
        $pathInfo = pathinfo($fileUrl);
        $fileUrl = $pathInfo['dirname'] . '/' . rawurlencode($pathInfo['basename']);
        $content = file_get_contents($fileUrl);
        [$width, $height] = getimagesize($fileUrl);
        if ($content) {
            do {
                $fileName = "{$this->generateRandomFileName($config['prefix'])}_${width}_${height}.{$pathInfo['extension']}";
                $fullFilePath = "{$this->getImageDirPath()}/$fileName";
            } while ($fileStorage->exists($fullFilePath));

            $fileStorage->put($fullFilePath, $content);

            return [
                'fileName' => $fileName,
                'path' => $fullFilePath,
            ];
        } else {
            return [];
        }
    }

    public function storeVideo($file, $config = [])
    {
        $config = array_merge(FileConstant::DEFAULT_CONFIG, $config);
        $fileStorage = Storage::disk($this->getFileStorageDiskNameForVideo());
        $prefix = $config['prefix'];
        $path = "{$this->getVideoDirPath()}/$prefix";

        if (!$fileStorage->exists($path)) {
            $fileStorage->makeDirectory($path);
            $fileStorage->setVisibility($path, 'public');
        }
        do {
            $fileName = "$prefix/{$this->generateRandomFileName($config['prefix'])}.{$file->guessExtension()}";
            $fullFilePath = "{$this->getVideoDirPath()}/$fileName";
        } while ($fileStorage->exists($fullFilePath));
        $originalName = $file->getClientOriginalName();
        $fileStorage->put($fullFilePath, fopen($file->getRealPath(), 'r'), 'public');
        $videoPath = Storage::url($fullFilePath);
        $url = asset($videoPath);
        return [
            'video_name' => $originalName,
            'video_path' => $url,
        ];
        return $fileName;
    }
}
