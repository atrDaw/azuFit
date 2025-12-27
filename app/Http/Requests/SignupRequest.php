<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|min:2|max:20',
            'surname' => 'required|string|min:2|max:20',
            'email' => 'required|string|min:10|max:255|email:filter|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener minimo 2 caracteres.',
            'name.max' => 'El nombre debe tener máximo 20 caracteres.',

            'surname.required' => 'El apellido es obligatorio.',
            'surname.min' => 'El apellido debe tener minimo 2 caracteres.',
            'surname.max' => 'El apellido debe tener máximo 20 caracteres.',

            'email.required' => 'El email es obligatorio.',
            'email.min' => 'El email debe tener minimo 10 caracteres.',
            'email.max' => 'El email debe tener máximo 255 caracteres.',
            'email.unique' => 'El email ya existe, prueba con otro.',
            'email.email' => 'El email debe ser una dirección de correo válida.',

            'password.required' => 'Contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',


        ];
    }
}
