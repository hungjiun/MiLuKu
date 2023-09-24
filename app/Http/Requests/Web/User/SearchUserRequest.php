<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;

class SearchUserRequest extends FormRequest
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
            'account'           => 'bail|nullable|string',
            'organization_type' => 'bail|nullable|string',
            'organization'      => 'bail|nullable|string',
            'role'              => 'bail|nullable|integer',
            'status'            => 'bail|nullable|integer',
            'sort_by'           => 'bail|required|string|in:created_at,updated_at',
            'order'             => 'bail|required|string|in:asc,desc',
            'page'              => 'bail|required|integer',
            'number_per_page'   => 'bail|required|integer',
        ];

    }
}
