<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'account'               => 'bail|required|string|min:4|max:50|unique:users,account',
            'password'              => 'bail|required|string|min:6|confirmed',
            'password_confirmation' => 'bail|required|string|min:6',
            'name'                  => 'bail|required|string|max:50',
            'email'                 => 'bail|nullable|email|max:255',
            'mobile'                => 'bail|present|nullable|string|max:13',
            'role_setting'          => 'bail|required|array',
            'organization_setting'  => 'bail|array',
            'brand_setting'         => 'bail|array',
            'store_setting'         => 'bail|array',
            'note'                  => 'bail|nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'account.required' => '帳號為必填',
            'account.unique' => '此帳號已存在',
            'password.required' => '密碼為必填',
            'password.min' => '密碼長度至少為六個字元',
            'password_confirmation.required' => '密碼確認為必填',
            'password.confirmed' => '請填入相同密碼',
            'name.required' => '名稱為必填',
            'name.max' => '名稱長度最大為50個字元',
            'email.max' => 'Email長度最大為255個字元',
            'mobile.max' => '手機號碼長度最大為13個字元',
            'note.max' => '備註長度最大為255個字元',
        ];
    }
}
