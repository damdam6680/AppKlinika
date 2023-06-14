<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Możliwość dodawania leczeń będzie sprawdzana w innym miejscu, np. w kontrolerze.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'treatment_name' => 'required|string',
            'description' => 'required|string',
            'waiting_time' => 'required|date_format:H:i:s',
            'price' => 'required|numeric',
        ];
    }
}

