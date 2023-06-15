<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ustaw zgodność z odpowiednimi regułami autoryzacji (np. sprawdzanie uprawnień użytkownika)
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
            'treatment_name' => 'required|string|max:50',
            'description' => 'required|string',
            'waiting_time' => 'required|date_format:H:i:s',
            'price' => 'required|numeric|between:0,999999.99'

        ];
    }
}

