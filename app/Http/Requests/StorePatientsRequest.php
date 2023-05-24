<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePatientsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'pesel' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
        ];
    }
    protected function prepareForValidation()
    {
        $this-> merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
