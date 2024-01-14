<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function registerpage()
    {
        return view('auth.register');
    }

    public function forgotpasswordpage()
    {
        return view('auth.forgotpassword');
    }


    public function register(Request $request)
    {
        //validate all input fields
        //take only vaild data
        // if any input field is empty then show error on blade template using 
        // @error('field name')
        // {{ $message }}
        // @enderror

        $rules = [
            'responder_name' => 'required|string|max:100',
            'email' => 'required|email|max:75|unique:users,email',
            'userfrom' => 'required|string|max:100',
            'password' => [
                'required',
                'string', 'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            ],

        ];
        $request->validate($rules);
        //first we write logic for registration
        //we need some hash token for verification
        $token = hash('sha256', time()); //we use time function to generate random string and sha256 is a hashing algorithm


        $user = new User();

        $user->responder_name = $request->responder_name;
        $user->userfrom = $request->userfrom;
        $user->email = $request->email;
        $user->username = "";
        $user->password = Hash::make($request->password); // we need to hash the password first
        $user->token = $token;
        $user->role = 'Super Admin';


        //i don't work with validation in this video
        //you can use validation and also confirm_password to match both password
        $user->save();

        //here we work on mail part logic
        //now we create a verification link
        //=================================
        $verificationLink = url('/verify/' . $token . '/' . $request->email . '/');
        $mailSubject = 'E-Ligtas Email Verification';
        $userData = [
            'responder_name' => $request->responder_name,
            'email' => $request->email,
            'link' => $verificationLink
        ];
        Mail::to($request->email)->send(new RegisterMail($mailSubject, $userData));
        //=================================

        //to save data in database
        return redirect('login')->with('success', 'You have successfully sign up, So please verify your email');
    }

    public function verifyAccount($token, $email)
    {
        //now we write our logic to empty the token and update the status as active
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            // if the user not exist means token is not exist or invaild token
            return 'User not found';
        }
        //else user found
        else {
            $user->token = ' '; //empty user token
            $user->status = 'active';
            $user->update();
        }

        return redirect('login')->with('success', 'You have been successfully verified, you can now sign in your account');
    }

    public function loginpage()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            // 'status' => 'active',

        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 'active') {
                if ($user->role == 'Super Admin') {
                    return redirect()->intended('admin/dashboard')->with('success', 'Log  in Successful. Welcome Back admin');
                } else {
                    return redirect()->intended('sector/dashboard');
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error-msg', 'Your email was not verified');
            }
        } else {

            return redirect()->route('login')->with('error-msg', 'Login Failed. Please check your Email & Password.');
        }
    }
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function forgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $passreset = Str::random(12, 'abcdefghijklmnopqrstuvwxyz123456789');

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found with the provided email.');
        }

        $user->update([
            'password' => $passreset,
        ]);

        $mailSubject = 'E-ligtas: Password Reset Successful';
        $mailData = [
            'responder_name' => $user->responder_name,
            'username' => $user->username,
            'email' => $request->email,
            'password' => $user->password = $passreset
        ];
        Mail::to($request->input('email'))->send(new ForgotPassword($mailSubject, $mailData));

        return redirect('login')->with('success', 'Successful Password Reset. Check your email for the new password.');
    }
}
