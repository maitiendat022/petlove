<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:users,name,'.auth()->user()->id,
            'phone' => 'numeric|nullable|digits:10|unique:users,phone,'.auth()->user()->id,
            'image' => 'nullable|image|mimes:png,jpg,PNG. jpeg',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được vượt quá 50 ký tự',
            'unique' => ':Attribute này đã được sử dụng',

            'image' => 'Vui lòng chọn hình ảnh',
            'mimes' => 'Định dạng ảnh này không cho phép.(Các định dạng có thể chọn:png,jpg,jpeg)',

            'digits' => 'Số điện phải phải là 10 số',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên',
            'password' => 'mật khẩu',
            'phone' => 'số điện thoại',
        ];
    }
}
