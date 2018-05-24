<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique',
            'type' => 'required|between:0,2',
            'password' => 'required|min:6|same:password_confirmation'
        ];
    }

    public function validate()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:6|same:password_confirmation'
        ];
    }


}
