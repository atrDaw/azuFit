<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model {
    protected $fillable = ['nombre'];    

    public function clases(){
        return $this->hasMany(Clase::class);
    }

    public function sesionesEnDirecto(){
        return $this->hasMany(SesionEnDirecto::class);
    }
}
