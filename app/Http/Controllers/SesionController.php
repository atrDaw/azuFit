<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionEnDirecto;

class SesionController extends Controller {
    public function index() {
        $sesiones = SesionEnDirecto::with('disciplina')
            ->where('fecha_hora', '>=', now())
            ->orderBy('fecha_hora', 'asc')
            ->get();
        return view('sesiones.index', compact('sesiones'));
    }
}
