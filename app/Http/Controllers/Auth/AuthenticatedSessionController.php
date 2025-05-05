<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Check if this is an OTP login
        if ($request->input('login_type') === 'otp') {
            return $this->handleOtpLogin($request);
        }

        // Regular email/password login
        $request->authenticate();

        $request->session()->regenerate();

        // Store login method in session
        session(['login_method' => 'Email & Password']);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handle OTP login process
     */
    protected function handleOtpLogin(Request $request): RedirectResponse
    {
        // Check if we're sending an OTP or verifying one
        if ($request->input('action') === 'send_otp') {
            return $this->sendOtp($request);
        } elseif ($request->input('action') === 'verify_otp') {
            return $this->verifyOtp($request);
        }

        return redirect()->route('login')->withErrors(['phone' => 'Invalid action']);
    }

    /**
     * Send OTP to the user's phone
     */
    protected function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'string'],
        ]);

        // Clean the phone number (remove spaces and non-numeric characters)
        $phone = preg_replace('/[^0-9]/', '', $request->phone);

        // Check if user exists with this phone number
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return redirect()->route('login')
                ->withInput()
                ->withErrors(['phone' => 'No account found with this phone number']);
        }

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session
        Session::put('otp', Hash::make($otp));
        Session::put('otp_phone', $phone);
        Session::put('otp_created_at', now());
        Session::put('phone', $phone); // For displaying in the form

        // In a real application, you would send the OTP via SMS here
        // For demo purposes, we'll just flash it to the session
        if (app()->environment('local')) {
            Session::flash('demo_otp', $otp);
        }

        return redirect()->route('login')
            ->with('otp_sent', true)
            ->with('status', 'OTP has been sent to your phone number');
    }

    /**
     * Verify the OTP entered by the user
     */
    protected function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
        ]);

        // Check if OTP is expired (5 minutes)
        $otpCreatedAt = Session::get('otp_created_at');
        if (!$otpCreatedAt || now()->diffInMinutes($otpCreatedAt) > 5) {
            return redirect()->route('login')
                ->withErrors(['otp' => 'OTP has expired. Please request a new one']);
        }

        // Verify OTP
        if (!Hash::check($request->otp, Session::get('otp'))) {
            return redirect()->route('login')
                ->with('otp_sent', true)
                ->withErrors(['otp' => 'Invalid OTP. Please try again']);
        }

        // Get user by phone
        $user = User::where('phone', Session::get('otp_phone'))->first();

        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['phone' => 'No account found with this phone number']);
        }

        // Login the user
        Auth::login($user, $request->boolean('remember'));

        // Clear OTP session data
        Session::forget(['otp', 'otp_phone', 'otp_created_at']);

        // Regenerate session
        $request->session()->regenerate();

        // Store login method in session
        session(['login_method' => 'Phone OTP']);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
