<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:50',
            'password' => 'sometimes|nullable|confirmed|min:6|max:50',
            'email' => [
                'required', 'email',
                Rule::unique('users','email')->ignore($this->user)
            ],
            'username' => [
                'required',
                Rule::unique('users','username')->ignore($this->user)
            ]
        ];
    }

 
}
