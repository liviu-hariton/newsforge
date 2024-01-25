<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required_if:section,personal|string',
            'lastname' => 'required_if:section,personal|string',
            'phone' => 'required_if:section,personal|string',

            'public_name' => 'required_if:section,public|string',
            'public_email' => 'required_if:section,public|email',
            'public_phone' => 'required_if:section,public|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstname.required_if' => 'The firstname is required in the Personal details',
            'lastname.required_if' => 'The lastname is required in the Personal details',
            'phone.required_if' => 'The phone number is required in the Personal details',

            'public_name.required_if' => 'The full name is required in the Public details',
            'public_email.required_if' => 'The email address is required in the Public details',
            'public_phone.required_if' => 'The phone number is required in the Public details',
        ];
    }
}
