<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyDataRequest extends FormRequest
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
            'name'   => 'bail|required|string|max:50',
            'email'  => 'bail|nullable|email|max:255',
            'mobile' => 'bail|present|nullable|string|max:13',
            'note'   => 'bail|nullable|string|max:255',
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
