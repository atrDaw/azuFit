<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionEnDirecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Disciplina;

class SesionController extends Controller {

    public function index(Request $request) {
        $userId = auth()->id();

        $query = SesionEnDirecto::with(['disciplina', 'reservas' => function ($query) use ($userId) { //añadir user id para ver si el usuario tiene reserva para mostrar estado
            if ($userId) {
                $query->where('user_id', $userId);
            }
        }]);    

        $query->where('fecha_hora', '>=', now());   

        if ($request->filled('disciplina_id')) {
            $query->where('disciplina_id', $request->disciplina_id);
        }

        $sesiones = $query->orderBy('fecha_hora', 'asc')->get();

        $sesionesPorDia = $sesiones->groupBy(function ($sesion) {
            return $sesion->fecha_hora->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY');
        });
        $disciplinas = Disciplina::all();
        return view('sesiones.index', compact('sesionesPorDia', 'disciplinas'));
    }

    public function show($id) {
        $sesion = SesionEnDirecto::with('disciplina')->findOrFail($id);
        return view('sesiones.show', compact('sesion'));
    }

    public function create() {
        if (!auth()->user()->is_admin) {
            abort(403, __('No autorizado para crear sesiones.'));
        }

        $disciplinas = Disciplina::all();
        return view('sesiones.create', compact('disciplinas'));
    }

    public function store(Request $request) {
        if (!auth()->user()->is_admin) {
            abort(403, __('No autorizado para crear sesiones.'));
        }

        //validacion de datos (crear fuera)

        $sesion = new SesionEnDirecto();
        $sesion->titulo = $request->titulo;
        $sesion->disciplina_id = $request->disciplina_id;
        $fechaHora = Carbon::createFromFormat('Y-m-d H:i', $request->fecha . ' ' . $request->hora); // se podria mejorar separando fecha y hora?
        $sesion->fecha_hora = $fechaHora;

        $sesion->url_sesion = $request->url_sesion;
        $sesion->save();
        return redirect()->route('sesiones.index')->with('success', __('Sesión creada con éxito.')); // mejor devolver sesiones.show?

    }

    public function edit($id) {
        if (!auth()->user()->is_admin) {
            abort(403, __('No autorizado para editar esta sesión.'));
        }

        $sesion = SesionEnDirecto::findOrFail($id);
        $disciplinas = Disciplina::all();
        return view('sesiones.edit', compact('sesion', 'disciplinas'));
    }

    public function update(Request $request, $id) {
        if (!auth()->user()->is_admin) {
            abort(403, __('No autorizado para editar esta sesión.'));
        }

        $sesion = SesionEnDirecto::findOrFail($id);

        $sesion->titulo = $request->titulo;
        $sesion->disciplina_id = $request->disciplina_id;
        $fechaHora = Carbon::createFromFormat('Y-m-d H:i', $request->fecha . ' ' . $request->hora);
        $sesion->fecha_hora = $fechaHora;
        $sesion->url_sesion = $request->url_sesion;
        $sesion->save();
        return redirect()->route('sesiones.index')->with('success', __('Sesión actualizada con éxito.'));
    }

    public function destroy($id) {
        if (!auth()->user()->is_admin) {
            abort(403, __('No autorizado para eliminar esta sesión.'));
        }

        $sesion = SesionEnDirecto::findOrFail($id);
        $sesion->delete();
        return redirect()->route('sesiones.index')->with('success', __('Sesión eliminada con éxito.'));
    }
}