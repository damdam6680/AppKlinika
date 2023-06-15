<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Możesz dodać tutaj odpowiednią logikę autoryzacji, jeśli jest wymagana.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'dentist_id' => ['required'],
            'treatmets_id' => ['required'],
            'visit_date' => ['required', 'date','after:08:00' ,'after_or_equal:today'],
            'visit_time' =>  ['required','date_format:H:i'],
            'description' =>  ['required'],
            'visit_end' => ['required', 'after:visit_time','date_format:H:i',
            'before:18:00'],

        ];
    }
    protected function prepareForValidation()
    {
        $this-> merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
