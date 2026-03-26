<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
            $users = User::all();
            return view('users.index', compact('users'));       

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }
    public function createAdmin()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    User::create([
        'name' => $request->nombre . ' ' . $request->apellido,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('home');
    }

    public function storeAdmin(Request $request)
{
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'is_admin' => 1
    ]);

    return redirect()->route('admin.dashboard');
}

public function admins()
{
    $admins = User::where('is_admin', 1)->get();

    return view('admin.index', compact('admins'));
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

}
