<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolesRequets extends FormRequest
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
            'name' =>  ['required','string','max:50','unique:roles,name,'.$this->role]
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được vượt quá 50 ký tự',
            'unique' => ':Attribute này đã được sử dụng',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên quyền',
        ];
    }
}
