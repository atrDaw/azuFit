<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SesionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [            
            'titulo' => 'required|string|max:255',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'url_sesion' => 'required|url',
        ];
    }

    public function messages()
    {
        return [            
            'titulo.required' => __('Por favor introduce un título.'),
            'titulo.string' => __('El título debe ser un texto.'),
            'titulo.max' => __('El título no puede superar los 255 caracteres.'),
            
            'disciplina_id.required' => __('Selecciona una disciplina.'),
            'disciplina_id.exists' => __('La disciplina seleccionada no es válida.'),
            
            'fecha.required' => __('Selecciona una fecha válida.'),
            'fecha.date' => __('El campo fecha no tiene un formato válido.'),
            'fecha.after_or_equal' => __('La fecha debe ser hoy o posterior.'),
            
            'hora.required' => __('Selecciona una hora.'),
            
            'url_sesion.required' => __('Introduce una URL válida.'),
            'url_sesion.url' => __('El formato del enlace no es válido.'),
        ];
    }
}