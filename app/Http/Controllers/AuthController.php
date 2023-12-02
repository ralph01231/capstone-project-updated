<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function registerpage()
    {
        return view('auth.register');
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:75|unique:users,email',
            'usertype' => 'required|string|max:100',
            'password' => [
                'required',
                'string',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            ],
            
        ];
        $request->validate($rules);
        //first we write logic for registration
        //we need some hash token for verification
        $token = hash('sha256', time()); //we use time function to generate random string and sha256 is a hashing algorithm
       


        $user = new User();
      
        $user->name = $request->name;
        $user->usertype = $request->usertype;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // we need to hash the password first
        $user->token = $token;
       
       if($user->usertype == 'admin'){
           $user->role = '1';
       }
       else{
            $user->role = '0';
       }

        
        //i don't work with validation in this video
        //you can use validation and also confirm_password to match both password
        $user->save();

        //here we work on mail part logic
        //now we create a verification link

        //=================================
        $verificationLink = url('/verify/' . $token . '/' . $request->email . '/');
        $mailSubject = 'E-Ligtas Email Verification';
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'link' => $verificationLink
        ];
        Mail::to($request->email)->send(new RegisterMail($mailSubject, $userData));
        //=================================
        
        //to save data in database
        return redirect('login')->with('success' , 'You have successfully sign up, So please verify your email');
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
            $user->token = ''; //empty user token
            $user->status = 'active';
            $user->update();
        }
       
        return redirect('login')->with('success', 'You have been successfully verified, you can now sign in your account');
    }

    public function loginpage(){
        return view('auth.login');
    }


    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
      
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                // 'status' => 'active',
                
            ];

            
            

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
               
                if ($user->status == 'active')
                {

                    if($user->role == '1'){
                        return redirect()->intended('admin/dashboard');
                    }
                    else
                    {
                        return redirect()->intended('sector/dashboard');
                    }
                }
                else{
                    Auth::logout();

                    return redirect()->route('login')->with('success','Your email was not verified');
                }
                   
                  
            }
            else {

               return redirect()->route('login')->with('success','Login Failed. Please check your Email & Password.');
            }
    }

        public function destroy(Request $request): RedirectResponse
        {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        }
}
