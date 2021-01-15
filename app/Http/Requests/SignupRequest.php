<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|'
        ];
    }

    public function messages()
    {
        $mess = ['email.unique' => 'email da ton tai!',
            'email.required' => 'kiem tra lai email!',
            'password.required'=>'kiem tra lai mat khau'];
        return $mess;
    }
}
