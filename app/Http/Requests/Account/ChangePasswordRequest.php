<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|different:old_password',
            'confirm_password' => 'required|string|same:new_password',
        ];

    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            'min' => ':Attribute phải lớn hơn 6 kí tự',

            'confirm_password.same' => 'Nhập lại mật khẩu không trùng khớp',
            'different' => 'Mật khẩu mới phải khác mật khẩu cũ'
        ];
    }
    public function attributes()
    {
        return [
            'old_password' => 'mật khẩu cũ',
            'new_password' => 'mật khẩu mới',
        ];
    }
}
