<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SesionEnDirecto extends Model {

    protected $table = 'sesiones_en_directo';

    protected $fillable = [
        'titulo',
        'disciplina_id',
        'fecha_hora',
        'url_sesion',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }

    public function reservas() {
        return $this->hasMany(Reserva::class, 'sesion_id');
    }

    public function usuarios() {
        return $this->belongsToMany(User::class, 'reservas', 'sesion_id', 'user_id')
            ->withPivot('estado')
            ->withTimestamps();
    }

    public function getEstaOcupadaAttribute() {
        return $this->reservas->contains('estado', 'confirmada');
    }

    public function getEstadoReservaAttribute() {
        return $this->reservas->firstWhere('user_id', Auth::id())?->estado;
    }

}
