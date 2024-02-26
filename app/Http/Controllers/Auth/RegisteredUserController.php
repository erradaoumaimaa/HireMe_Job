<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Afficher le formulaire d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Gérer une demande d'inscription.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'role' => ['required', 'string', 'in:user,company'],
        ]);

        $image_profile = null;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $image_profile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $image_profile);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image_profile,
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('profile.edit');
    }
}
