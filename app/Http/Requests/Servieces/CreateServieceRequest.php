<?php

namespace App\Http\Requests\Servieces;

use Illuminate\Foundation\Http\FormRequest;

class CreateServieceRequest extends FormRequest
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
            'name' =>  ['required','string','unique:servieces,name']
        ];

    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':Attribute này đã tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'dịch vụ',
        ];
    }
}
