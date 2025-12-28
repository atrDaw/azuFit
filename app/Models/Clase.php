<?php

namespace App\Models;

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

}
