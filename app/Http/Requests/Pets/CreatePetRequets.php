<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;

class CreatePetRequets extends FormRequest
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
            'name' =>  ['required','string','max:50','unique:pets,name']
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'unique' => ':Attribute này đã tồn tại',
            'max' => ':Attribute không quá 50 kí tự',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tên thú cưng',
        ];
    }
}
