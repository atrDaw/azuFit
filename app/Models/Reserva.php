<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {
    protected $fillable = [
        'user_id',
        'sesion_id',
        'fecha_reserva',
        'estado',
        'mail_enviado',
    ];

    protected $casts =[
        'fecha_reserva' => 'datetime',
        'mail_enviado' => 'boolean',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }   
    public function sesion(){
        return $this->belongsTo(SesionEnDirecto::class, 'sesion_id');
    }
}
