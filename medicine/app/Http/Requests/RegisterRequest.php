<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'fullname' => 'required|min:5',
            'gender' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return[
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không đúng cú pháp. Ví dụ: abc@gmail.com',
            'email.unique' => 'Email đã tồn tại',
            'fullname.required' => 'Bạn chưa nhập họ và tên',
            'fullname.min' => 'Họ và tên phải tối thiểu 5 kí tự',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            'confirm_password.required' => 'Bạn chưa xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu đã nhập'
        ];
    }
}
