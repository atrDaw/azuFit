<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionEnDirecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SesionController extends Controller {

    public function index() {
        $userId = auth()->id();
        $sesiones = SesionEnDirecto::with(['disciplina', 'reservas' => function ($query) use ($userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            }
        }])
            ->where('fecha_hora', '>=', now())
            ->orderBy('fecha_hora', 'asc')
            ->get();

        $sesionesPorDia = $sesiones->groupBy(function ($fecha) {
            return Carbon::parse($fecha->fecha_hora)->locale('es')->isoFormat('dddd D [de] MMMM');
        });
        return view('sesiones.index', compact('sesionesPorDia'));
    }
}
