<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session (or database for production)
        session(['otp' => $otp, 'otp_email' => $request->email]);

        // Send OTP via email
        Mail::to($request->email)->send(new OTPMail($otp));

        return response()->json([
            'message' => 'OTP sent successfully!',
            'otp' => $otp // Remove this in production!
        ]);
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $sessionOTP = session('otp');
        $sessionEmail = session('otp_email');

        if ($request->otp == $sessionOTP && $request->email == $sessionEmail) {
            // Clear OTP from session
            session()->forget(['otp', 'otp_email']);

            return response()->json(['message' => 'OTP verified successfully!']);
        }

        return response()->json(['message' => 'Invalid OTP!'], 400);
    }
}
