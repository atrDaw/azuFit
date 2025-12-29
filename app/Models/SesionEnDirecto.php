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

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }
    public function reservas() {
        return $this->hasMany(Reserva::class, 'sesion_id');
    }
    public function usuarios() {
        return $this->belongsToMany(User::class, 'reservas', 'sesion_id', 'user_id')
            ->withTimestamps();
    }
    public function getEstadoReservaAttribute() {
        
        // Buscamos en la colección de reservas YA cargada (eager loaded)
        // para evitar una consulta SQL extra por cada sesión.
        // Usamos firstWhere que busca en memoria.
        return $this->reservas->firstWhere('user_id', Auth::id())?->estado;
    }
}
