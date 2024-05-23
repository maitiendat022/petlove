<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'serviece_id' => 'required',
            'book_name' => 'required|string',
            'book_phone' => 'required|nullable|digits:10',
            'pet_name' => 'required|string',
            'pet_age' => 'required',
            'pet_specie' => 'required|string',
            'pet_weight' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập :attribute',
            'digits' => 'Số điện phải phải là 10 số',
            'serviece_id.required'=>'Vui lòng chọn loại dịch vụ',
        ];
    }
    public function attributes()
    {
        return [
            'book_name' => 'tên',
            'book_phone' => 'số điện thoại',
            'pet_name' => 'tên thú cưng',
            'pet_age' => 'tuổi thú cưng',
            'pet_specie' => 'giống thú cưng',
            'pet_weight' => 'cân nặng của thú cưng',
        ];
    }
}
