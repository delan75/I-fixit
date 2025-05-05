<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// OTP Routes
Route::post('/send-otp', function (Request $request) {
    // Validate the request
    $request->validate([
        'phone' => 'required|string',
    ]);

    // In a real application, you would:
    // 1. Check if the phone number exists in your database
    // 2. Generate a random OTP
    // 3. Store the OTP in the database or cache with an expiration time
    // 4. Send the OTP via SMS using a service like Twilio, Vonage, etc.

    // For demo purposes, we'll just return a success response
    return response()->json([
        'success' => true,
        'message' => 'OTP sent successfully',
    ]);
});
