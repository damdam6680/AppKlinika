<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatePatientsRequest extends FormRequest
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
        if($method == "PUT"){
            return [
                'user_id' => ['required'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'pesel' => ['required'],
                'address' => ['required'],
                'phone' => ['required'],
            ];
        }else{
            return [
                'user_id' => ['sometimes','required'],
                'first_name' => ['sometimes','required'],
                'last_name' => ['sometimes','required'],
                'pesel' => ['sometimes','required'],
                'address' => ['sometimes','required'],
                'phone' => ['sometimes','required'],
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
