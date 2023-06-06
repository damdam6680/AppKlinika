<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
class StoreAppointmentsRequest extends FormRequest
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
            'patient_id' =>  ['required'],
            'dentist_id' => ['required'],
            'visit_date' => ['required'],
            'visit_time' =>  ['required'],
            'description' =>  ['required'],
            'visit_end' => ['visit_end'],
        ];
    }
    protected function prepareForValidation()
    {
        $this-> merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
