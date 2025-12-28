<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model {
    protected $fillable = [
        'titulo',
        'descripcion',
        'disciplina_id',
        'nivel',
        'url_video',
    ];

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }

    public function getEsLocalAttribute() {
        // Si la URL NO empieza por 'http', asumimos que es un archivo local
        return !Str::startsWith($this->url_video, 'http');
    }

    public function getVideoEmbedAttribute() {
        $url = $this->url_video;

        if ($this->es_local) {
            return asset('storage/' . $url);
        }

        // Esta expresión regular extrae el ID de cualquier enlace de YouTube
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
