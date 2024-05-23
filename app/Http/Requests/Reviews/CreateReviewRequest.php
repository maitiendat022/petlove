<?php

namespace App\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
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
            'comment' =>  ['required'],
            'image' => 'image|mimes:png,jpg,PNG. jpeg',
        ];

    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập thông tin :attribute',
            'image' => 'Vui lòng chọn ảnh',
            'mimes' => 'Định dạng ảnh này không cho phép.(Các định dạng có thể chọn:png,jpg,jpeg)',
        ];
    }
    public function attributes()
    {
        return [
            'comment' => 'đánh giá',
        ];
    }
}
