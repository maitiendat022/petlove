<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequets extends FormRequest
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
            'name' => 'required|string|max:50|unique:categories,name,'.$this->category,
            'pet_id' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':Attribute này đã tồn tại',

            'pet_id.required' => 'Vui lòng chọn loại thú cưng',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên danh mục',
        ];
    }
}
