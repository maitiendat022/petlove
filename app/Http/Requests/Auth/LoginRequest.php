<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/|max:255',
            'password' => 'required|string|max:50|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được vượt quá 50 ký tự',
            'min' => ':Attribute phải lớn hơn 6 kí tự',
            'email' => 'Địa chỉ email không hợp lệ',
            'email.max' => ':Attribute không được vượt quá 255 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
        ];
    }
}
