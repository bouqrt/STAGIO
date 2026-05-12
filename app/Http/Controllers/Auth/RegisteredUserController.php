<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the basic registration fields.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,entreprise'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            // Create the user with the selected role.
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            // Create a minimal entreprise profile immediately when the role is entreprise.
            if ($user->role === 'entreprise') {
                $user->entreprise()->create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                ]);
            }

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'entreprise') {
            return redirect()->route('entreprise.create')
                ->with('success', 'Account created. Complete your entreprise profile.');
        }

        return redirect()->route('dashboard');
    }
}
