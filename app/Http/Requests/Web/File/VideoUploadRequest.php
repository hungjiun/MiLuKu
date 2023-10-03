<?php

namespace App\Http\Requests\Web\File;

use Illuminate\Foundation\Http\FormRequest;

class VideoUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'video' => 'mimetypes:video/mp4|max:10240',
            'prefix' => 'bail|nullable|string',
        ];
    }
}
