<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentsRequest extends FormRequest
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
    public function rules()
    {
        $method = $this->method();
        if ($method == "PUT") {
            return [
                'patient_id' => 'required|integer|unique:appointments,patient_id',
                'dentist_id' => 'required|integer|unique:appointments,dentist_id',
                'treatments_id' => 'required|integer|unique:appointments,treatments_id',
                'visit_date' => 'required|date',
                'visit_time' => 'required|date_format:H:i',
                'visit_end' => 'required|date_format:H:i',
                'description' => 'required',
                'isAccepted' => 'required|boolean',
            ];
        } else {
            return [
                'patient_id' => 'sometimes|required|integer|unique:appointments,patient_id',
                'dentist_id' => 'sometimes|required|integer|unique:appointments,dentist_id',
                'treatments_id' => 'sometimes|required|integer|unique:appointments,treatments_id',
                'visit_date' => 'sometimes|required|date',
                'visit_time' => 'sometimes|required|date_format:H:i',
                'visit_end' => 'sometimes|required|date_format:H:i',
                'description' => 'sometimes|required',
                'isAccepted' => 'sometimes|required|boolean',
            ];
        }
    }
}
