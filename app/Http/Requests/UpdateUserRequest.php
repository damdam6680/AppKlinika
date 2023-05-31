<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        // Określ, czy użytkownik ma uprawnienia do wykonania tego żądania
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'role' => 'required',
        ];
    }
}
