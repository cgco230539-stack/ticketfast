<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController
{
     // Método para regresar vista del formulario de registro
    public function registerForm(){
    
    return view('auth.register');
    
    }
    
    // Método para guardar la información de registro
    public function register(Request $request){
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users',
        'phone'    => 'required',
        'password' => 'required|confirmed|min:8',
    ], [
        'email.unique'        => 'Este correo ya está en uso.',
        'email.required'      => 'El correo es obligatorio.',
        'name.required'       => 'El nombre es obligatorio.',
        'phone.required'      => 'El teléfono es obligatorio.',
        'password.required'   => 'La contraseña es obligatoria.',
        'password.confirmed'  => 'Las contraseñas no coinciden.',
        'password.min'        => 'La contraseña debe tener al menos 8 caracteres.',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'phone'    => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('home')
        ->with('success', '¡Cuenta creada exitosamente! Bienvenido, ' . $user->name . '.');
    }

   // Método para regresar la vista del inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }
    
        // Método para iniciar sesión
    public function login(Request $request){
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        event(new UserLoggedIn(
            auth()->user(),
            $request->ip() ?? 'IP no disponible',
            $request->userAgent() ?? 'Dispositivo no identificado',
            Carbon::now()->format('d/m/Y H:i:s')
        ));

        return redirect()->route('home')
            ->with('success', 'Bienvenido, ' . auth()->user()->name . '!');
    }

    return back()->with('error', 'Correo o contraseña incorrectos.');
    }
    
        // Método para cerrar sesión
    public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home')
        ->with('warning', 'Has cerrado sesión correctamente.');
    }
}
