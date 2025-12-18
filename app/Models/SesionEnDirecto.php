<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionEnDirecto extends Model {
    protected $fillable = [
        'titulo',
        'disciplina_id',
        'fecha_hora',
        'url_sesion',
    ];

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }
}
