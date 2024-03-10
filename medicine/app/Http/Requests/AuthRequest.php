<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng cú pháp. Ví dụ: abc@gmail.com',
            'email.exists' => 'Email chưa được đăng kí',
            'password.required' => 'Bạn chưa nhập mật khẩu',
        ];
    }
}
