<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function signupForm() {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request) {
        try {

            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->is_student ? 3 : 2;
            $user->save();
            // throw new \Exception('¡Esto es un simulacro de error!');
            return redirect()->route('login')->with('success', '¡Cuenta creada con éxito! Por favor inicia sesión.');
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un error al crear tu cuenta. Por favor, inténtalo de nuevo.')
                ->withInput();
        }
    }
}
