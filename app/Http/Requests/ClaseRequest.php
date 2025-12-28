<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaseRequest extends FormRequest {
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
            'titulo' => 'required|string|min:2|max:20',
            'descripcion' => 'required|string|min:10|max:255',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'nivel' => 'required|in:Principiante,Intermedio,Avanzado',
            'video_file' => 'file|mimes:mp4,mov,avi,wmv|max:20480',
            'url_video' => 'nullable|url',
        ];
    }
    public function messages() {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.min' => 'El título debe tener mínimo 2 caracteres.',
            'titulo.max' => 'El título debe tener máximo 20 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener mínimo 10 caracteres.',
            'descripcion.max' => 'La descripción debe tener máximo 255 caracteres.',

            'disciplina_id.required' => 'La disciplina es obligatoria.',
            'disciplina_id.exists' => 'La disciplina seleccionada no es válida.',

            'nivel.required' => 'El nivel es obligatorio.',
            'nivel.in' => 'El nivel seleccionado no es válido. Debe ser Principiante, Intermedio o Avanzado.',
            
            'video_file.file' => 'El archivo de video debe ser un archivo válido.',
            'video_file.mimes' => 'El archivo de video debe ser de tipo mp4, mov, avi o wmv.',
            'video_file.max' => 'El archivo de video no debe superar los 20MB.',
            'url_video.url' => 'La URL del video debe ser una URL válida.',
        ];
    }
}
