<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignUpRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required',
            'password' => 'required|min:8'
        ];
    }
    
    /** 
     * Set custom messages for validator errors.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'This email already exists in our system.',
            'password.min' => 'Password must be at least 8 characters.'
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator
     * @return mixed
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
