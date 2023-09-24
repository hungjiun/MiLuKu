<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id'                    => 'bail|required|integer',
            'name'                  => 'bail|required|string|max:50',
            'email'                 => 'bail|nullable|email|max:255',
            'mobile'                => 'bail|present|nullable|string|max:13',
            'role_setting'          => 'bail|required|array',
            'organization_setting'  => 'bail|array',
            'brand_setting'         => 'bail|array',
            'store_setting'         => 'bail|array',
            'note'                  => 'bail|nullable|string|max:255',
            'status'                => 'bail|required|integer|in:1,2'
        ];

    }

    public function messages()
    {
        return [
            'name.required' => '名稱為必填',
            'name.max' => '名稱長度最大為50個字元',
            'email.max' => 'Email長度最大為255個字元',
            'mobile.max' => '手機號碼長度最大為13個字元',
            'note.max' => '備註長度最大為255個字元',
        ];
    }
}
