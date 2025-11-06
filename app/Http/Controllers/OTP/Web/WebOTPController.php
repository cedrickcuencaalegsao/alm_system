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

    public function viewVerifyOTP()
    {
        return view('Page.VerifyOTP.verifyotp');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);
        $sessionOTP = session('otp');
        $sessionEmail = session('otp_email');

        // Successful verification
        if ($request->otp == $sessionOTP && $request->email == $sessionEmail) {
            // Save email for the reset flow and clear OTP
            session(['reset_email' => $request->email]);
            session()->forget(['otp', 'otp_email']);

            // Respond according to request type
            if ($request->expectsJson()) {
                return response()->json(['message' => 'OTP verified successfully!']);
            }

            // For web form, return to the verify page with a flag so it can show a success modal
            return redirect()->back()->with('otp_verified', true);
        }

        // Invalid OTP/email
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Invalid OTP!'], 400);
        }

        return back()->withErrors(['otp' => 'Invalid OTP or email.'])->withInput();
    }
}
