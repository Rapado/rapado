<?php

namespace App\Http\Controllers\Auth\Peluqueria;

use App\Http\Controllers\Controller;
use App\Models\Peluqueria;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserPeluqueriaController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        dd('controllador del peluquero');
        // return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'numeroLocal' => 'required',
            'nombrePeluqueria' => 'required|string|min:3|max:150',
        ]);

        Auth::login($user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => 'peluqueria'
        ]));

        $peluqueria = new Peluqueria();
        $peluqueria->user_id = Auth::id();
        $peluqueria->telefono = $request['numeroLocal'];
        $peluqueria->nombre = $request['nombrePeluqueria'];
        $peluqueria->save();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOMEPELUQUERIA);
    }
}
