<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'phone' => 'required|digits:10',
            'city' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'ward' => 'required|string|max:50',
            'address' => 'required|string',
        ];

    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'max' => ':Attribute không được vượt quá 50 ký tự',

            'digits' => 'Số điện phải phải là 10 số',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên',
            'phone' => 'số điện thoại',
            'city' => 'tình/thành phố',
            'district' => 'quận/huyện',
            'ward' => 'phường/xã',
            'address' => 'địa chỉ chi tiết',
        ];
    }
}
