<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequets extends FormRequest
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
            'name' => 'required|string|max:50|unique:users,name,'.$this->user,
            'role_id' => 'required',
            'phone' => 'numeric|nullable|digits:10|unique:users,phone,'.$this->user,
            'image' => 'nullable|image|mimes:png,jpg,PNG. jpeg',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được vượt quá 50 ký tự',
            'unique' => ':Attribute này đã được sử dụng',
            'min' => ':Attribute phải lớn hơn 6 kí tự',

            'role_id.required' => 'Vui lòng chọn :attribute',

            'image' => 'Vui lòng chọn ảnh',
            'mimes' => 'Định dạng ảnh này không cho phép.(Các định dạng có thể chọn:png,jpg,jpeg)',

            'digits' => 'Số điện phải phải là 10 số',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên',
            'password' => 'mật khẩu',
            'role_id' => 'loại tài khoản',
            'phone' => 'số điện thoại',
        ];
    }
}
