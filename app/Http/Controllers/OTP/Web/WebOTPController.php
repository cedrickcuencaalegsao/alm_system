<?php

namespace App\Http\Controllers\OTP\Web;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebOTPController extends Controller
{
    public function viewSendOTP()
    {
        return view('Page.SendOTPToEmail.sendotptoemail');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP in session (or database for production)
        session(['otp' => $otp, 'otp_email' => $request->email]);

        // Send OTP via email
        Mail::to($request->email)->send(new OTPMail($otp));

        return redirect()->back()->with('otp_sent', 'An OTP has been sent to your email address!');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
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
