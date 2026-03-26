<?php

namespace App\Http\Controllers;

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
        // Validaciones de los campos del formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        ]);

        // Iniciar sesión de forma automática
    Auth::login($user);

    return redirect()->route('home');

    }

   // Método para regresar la vista del inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }
    
        // Método para iniciar sesión
    public function login(Request $request){
        // Validar la información del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar el inicio de sesión
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // Iniciar sesión y redireccionar al usuario con sesión activa
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Datos incorrectos'
        ]);
    } 
    
        // Método para cerrar sesión
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
