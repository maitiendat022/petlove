<?php

namespace App\Http\Requests\Auth;

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
            //
            'name' => 'required|string|max:50|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:50|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':Attribute này đã được sử dụng',
            'max' => ':Attribute không được vượt quá 50 ký tự',
            'min' => ':Attribute phải lớn hơn 6 kí tự',
            'email' => 'Địa chỉ email không hợp lệ',
            'email.max' => ':Attribute không được vượt quá 255 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên',
            'password' => 'mật khẩu',
        ];
    }
}
