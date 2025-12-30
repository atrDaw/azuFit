<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reserva;
use App\Models\SesionEnDirecto;

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
        $sesion= SesionEnDirecto::findOrFail($request->sesion_id);

        if($sesion->reservas()->where('estado','confirmada')->exists()){
            return back()->with('error', 'Lo siento, esta sesión ya ocupada por otro usuario.');
        }

        $existe = Reserva::where('user_id', $user->id)
            ->where('sesion_id', $request->sesion_id)
            ->exists();
            
        $cancelada = Reserva::where('user_id', $user->id)
            ->where('sesion_id', $request->sesion_id)
            ->where('estado', 'cancelada')
            ->exists();

        if ($existe && !$cancelada) {
            return back()->with('error', 'Ya tienes una solicitud para esta sesión.');
        } else if ($cancelada) {
            Reserva::where('user_id', $user->id)
                ->where('sesion_id', $request->sesion_id)
                ->where('estado', 'cancelada')
                ->update(['estado' => 'pendiente']);
            return redirect()->back()->with('success', 'Reserva reactivada con éxito.');
        }
        Reserva::create([
            'user_id' => $user->id,
            'sesion_id' => $request->sesion_id,
            'estado' => 'pendiente',
            //gestionar mail enviado
        ]);
        return redirect()->back()->with('success', 'Solicitud enviada con éxito.');
    }

    public function update(Request $request, $id) {
        if (!auth()->user()->is_admin) abort(403);
        $reserva=Reserva::findOrFail($id);
        $nuevoEstado=$request->input('estado');
        if($nuevoEstado==='confirmada'){
            $yaOcupada=Reserva::where('sesion_id',$reserva->sesion_id)
                ->where('estado','confirmada')
                ->where('id','!=',$reserva->id)
                ->exists();
            if($yaOcupada){
                return redirect()->back()->with('error', 'No se puede confirmar la reserva porque la sesión ya está ocupada.');
            }
        }
        $reserva->estado=$nuevoEstado;
        $reserva->save();
        return redirect()->back()->with('success', 'Estado de la reserva actualizado.');

    }

    public function destroy($id) {
        $reserva = Reserva::where('user_id', Auth::id())->findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva cancelada.');
    }

    public function panel(){
        if (!auth()->user()->is_admin) abort(403, 'Acceso denegado');
         $reservas = Reserva::with(['user', 'sesion.disciplina'])
            ->orderByRaw("FIELD(estado, 'pendiente', 'confirmada', 'cancelada')")
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.reservas.index', compact('reservas'));
    }
}
