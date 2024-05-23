<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequets extends FormRequest
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
            'name' => 'required|string|min:6|unique:products,name',
            'description' => 'required',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:png,jpg,PNG. jpeg',
            'category_id' => 'required',
            'size' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':Attribute này đã tồn tại',
            'min' => ':Attribute phải lớn hơn 6 kí tự',

            'category_id.required' => 'Vui lòng chọn danh mục phụ',

            'size.required' => 'Vui lòng tạo chi tiết sản phẩm',

            'image.required' => 'Vui lòng chọn ảnh',
            'mimes' => 'Định dạng ảnh này không cho phép.(Các định dạng có thể chọn:png,jpg,jpeg)',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên sản phẩm',
            'description' => 'mô tả',
        ];
    }
}
