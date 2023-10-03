<?php

namespace App\Http\Controllers\API\Web\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\File\ImageUploadRequest;
use App\Http\Requests\Web\File\VideoUploadRequest;
use App\Http\Responses\ECResponse;
use App\Modules\File\Services\FileStorageService;

class UploadController extends Controller
{
    /** @var $fileStorageService FileStorageService */
    protected $fileStorageService;

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function storeImage(ImageUploadRequest $request)
    {
        $file = $request->file('image');
        $fileNamePrefix = $request->get('prefix', '');
        //$image = $this->fileStorageService->storeImage($file, ['prefix' => $fileNamePrefix]);
        $image = $this->fileStorageService->storeImage($file);
        return new ECResponse($image);
    }

    public function storeVideo(VideoUploadRequest $request)
    {
        $file = $request->file('video');
        $fileNamePrefix = $request->get('prefix', '');
        return new ECResponse([
            'filename' => $this->fileStorageService->storeVideo($file, ['prefix' => $fileNamePrefix]),
        ]);
    }
}
