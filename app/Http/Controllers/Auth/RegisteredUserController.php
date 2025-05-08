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
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check for existing (even inactive) user with same email or phone
        $inactiveUser = User::where(function($q) use ($request) {
            $q->where('email', $request->email)->orWhere('phone', $request->phone);
        })->where('status', 'inactive')->first();
        if ($inactiveUser) {
            return back()->withInput()->withErrors([
                'email' => 'Invalid email or phone number.',
                'phone' => 'Invalid email or phone number.'
            ]);
        }
        // Check for active user (for unique validation)
        $request->validate([
            'email' => 'unique:users,email',
            'phone' => 'unique:users,phone',
        ]);

        // Only collect safe user input
        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => "{$request->first_name} {$request->last_name}",
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            // Always set default role and status explicitly
            'role' => 'user',
            'status' => 'active',
        ];

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        // Debugging: Log user authentication status
        if (!Auth::check()) {
            logger('User not authenticated after registration.');
        } else {
            logger('User authenticated successfully.');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
