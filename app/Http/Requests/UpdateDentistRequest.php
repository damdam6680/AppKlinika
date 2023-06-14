<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDentistRequest extends FormRequest
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
        if ($method === 'PUT') {
            return [
                'user_id' => ['required'],
                'first_name' => ['required', 'string', 'max:50'],
                'last_name' => ['required', 'string', 'max:50'],
                'specialization' => ['required', 'string', 'max:50'],
                'phone_number' => ['required', 'string', 'max:20'],
            ];
        } else {
            return [
                'user_id' => ['sometimes', 'required'],
                'first_name' => ['sometimes','required', 'string', 'max:50'],
                'last_name' => ['sometimes','required', 'string', 'max:50'],
                'specialization' => ['sometimes','required', 'string', 'max:50'],
                'phone_number' => ['sometimes','required', 'string', 'max:20'],
            ];
        }

    }
    protected function prepareForValidation()
    {
        $this-> merge([
            'postal_code' => $this->postalCode
        ]);
    }
}