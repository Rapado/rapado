<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\Administrador;

class RegisteredUserAdminController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
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
            'codigoDeAcceso' => [ 'required',
                                Rule::exists('administradors', 'id')->where(function ($query) {
                                    return $query->where('user_id', null);
                                }),
                            ],
        ]);


        Auth::login($user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => 'admin',
            ]));

        $administrador = Administrador::find($request['codigoDeAcceso']);
        $administrador->user_id =  Auth::id();
        $administrador->save();

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOMEADMIN);
    }
}
