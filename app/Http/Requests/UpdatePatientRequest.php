<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientRequest extends FormRequest
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
        $method = $this->method();
        if ($method === "PUT") {
            return [
                'user_id' => ['required'],
                'first_name' => ['required', 'regex:/^[^0-9]+$/'],
                'last_name' => ['required', 'regex:/^[^0-9]+$/'],
                'pesel' => ['required', 'digits:11'],
                'address' => ['required'],
                'phone' => ['required', 'regex:/^\d{3}-\d{3}-\d{3}$/'],
                'gender' => ['required', Rule::in(['male', 'female'])],
                'birthday' => ['required', 'date_format:d/m/Y']
            ];
        } else {
            return [
                'user_id' => ['sometimes', 'required'],
                'first_name' => ['sometimes', 'required', 'regex:/^[^0-9]+$/'],
                'last_name' => ['sometimes', 'required', 'regex:/^[^0-9]+$/'],
                'pesel' => ['sometimes', 'required', 'digits:11'],
                'address' => ['sometimes', 'required'],
                'phone' => ['sometimes', 'required', 'regex:/^\d{3}-\d{3}-\d{3}$/'],
                'gender' => ['sometimes', 'required', Rule::in(['male', 'female'])],
                'birthday' => ['sometimes', 'required', 'date_format:d/m/Y']
            ];
        }
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
}

