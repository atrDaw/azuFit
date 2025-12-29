<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reserva;

class ReservaController extends Controller {
    public function index() {
        $user = Auth::user();
        $reservas = $user->reservas()->with('sesion.disciplina')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function store(Request $request) {
        $request->validate([
            'sesion_id' => 'required|exists:sesiones_en_directo,id',
        ]);

        $user = Auth::user();

        $existe = Reserva::where('user_id', $user->id)
            ->where('sesion_id', $request->sesion_id)
            ->exists();
        if ($existe) {
            return back()->with('error', 'Ya tienes una reserva para esta sesión.');
        }
        Reserva::create([
            'user_id' => $user->id,
            'sesion_id' => $request->sesion_id,
            'estado' => 'pendiente',
            //gestionar mail enviado
        ]);
        return redirect()->back()->with('success', 'Reserva creada con éxito.');
    }

    public function destroy($id) {
        $reserva = Reserva::where('user_id', Auth::id())->findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada.');
    }
}
