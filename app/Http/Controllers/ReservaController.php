<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reserva;
use App\Models\SesionEnDirecto;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewRequestAdminEmail;
use App\Mail\ReservationConfirmedEmail;


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
        $sesion = SesionEnDirecto::findOrFail($request->sesion_id);

        if ($sesion->reservas()->where('estado', 'confirmada')->exists()) {
            return back()->with('error', __('Lo siento, esta sesión ya ocupada por otro usuario.'));
        }

        $existe = Reserva::where('user_id', $user->id)
            ->where('sesion_id', $request->sesion_id)
            ->exists();

        $cancelada = Reserva::where('user_id', $user->id)
            ->where('sesion_id', $request->sesion_id)
            ->where('estado', 'cancelada')
            ->exists();

        if ($existe && !$cancelada) {
            return back()->with('error', __('Ya tienes una solicitud para esta sesión.'));
        } else if ($cancelada) {
            $reserva = Reserva::where('user_id', $user->id)
                ->where('sesion_id', $request->sesion_id)
                ->where('estado', 'cancelada')
                ->first();
            $reserva->update(['estado' => 'pendiente']);
            $this->enviarMailAdmin($reserva);
            return redirect()->back()->with('success', __('Reserva reactivada con éxito.'));
        }

        $reserva = Reserva::create([
            'user_id' => $user->id,
            'sesion_id' => $request->sesion_id,
            'estado' => 'pendiente',
        ]);

        $this->enviarMailAdmin($reserva);

        return redirect()->back()->with('success', __('Solicitud enviada con éxito.'));
    }

    public function update(Request $request, $id) {

        if (!auth()->user()->is_admin) abort(403);

        $reserva = Reserva::findOrFail($id);
        $nuevoEstado = $request->input('estado');

        if ($nuevoEstado === 'confirmada') {
            $yaOcupada = Reserva::where('sesion_id', $reserva->sesion_id)
                ->where('estado', 'confirmada')
                ->where('id', '!=', $reserva->id)
                ->exists();
            if ($yaOcupada) {
                return redirect()->back()->with('error', __('No se puede confirmar la reserva porque la sesión ya está ocupada.'));
            }
        }
        $reserva->estado = $nuevoEstado;
        $reserva->save();

        if ($nuevoEstado === 'confirmada') {
            try {
                Mail::to($reserva->user->email)->send(new ReservationConfirmedEmail($reserva));
            } catch (\Exception $e) {
                // Loguear el error para depuración
            }
        }

        return redirect()->back()->with('success', __('Estado de la reserva actualizado.'));
    }

    public function destroy($id) {
        $reserva = Reserva::where('user_id', Auth::id())->findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', __('Reserva cancelada.'));
    }

    public function panel(Request $request) {
        if (!auth()->user()->is_admin) abort(403, __('Acceso denegado'));

        $query = Reserva::with(['user', 'sesion.disciplina']);

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $reservas = $query->orderByRaw("FIELD(estado, 'pendiente', 'confirmada', 'cancelada')")
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reservas.index', compact('reservas'));
    }

    private function enviarMailAdmin($reserva) {
        try {
            $adminUser = User::where('role_id', 1)->first();
            $adminEmail = $adminUser ? $adminUser->email : 'admin@azufit.com';

            Mail::to($adminEmail)->send(new NewRequestAdminEmail($reserva));
        } catch (\Exception $e) {
            // Loguear el error para depuración
        }
    }
}