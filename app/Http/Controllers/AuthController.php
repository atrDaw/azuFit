<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class AuthController extends Controller {
    public function showLoginForm() {
        if (Auth::check()) {
            return view('auth.user', ['user' => Auth::user()]);
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Texto envuelto en __()
            return redirect()->intended(route('home'))->with('success', __('Has iniciado sesión correctamente.'));
        }
        return back()->withErrors([
            // Texto envuelto en __()
            'email' => __('Las credenciales no coinciden.'),
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Texto envuelto en __()
        return redirect('/')->with('success', __('Has cerrado sesión correctamente.'));
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

            Mail::to($user->email)->send(new WelcomeEmail($user));
            
            // Texto envuelto en __()
            return redirect()->route('login')->with('success', __('¡Cuenta creada con éxito! Por favor inicia sesión.'));
        } catch (\Exception $e) {
            return redirect()->back()
                // Texto envuelto en __()
                ->with('error', __('Hubo un error al crear tu cuenta. Por favor, inténtalo de nuevo.'))
                ->withInput();
        }
    }
}