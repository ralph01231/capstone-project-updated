<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function updatePassword(Request $request){
        
        $id = Auth::user()->responder_id;
        $user = User::find($id);

        $request->validate([
            'current_password' => 'required_with:password|string|min:8',
        'password' => [
            'required',
            'string', 'confirmed',
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()
        ],
        ]);

       // Check if the current password is correct if provided
    if ($request->filled('current_password')) {
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error-msg' , 'Your current password is Incorrect');
        }
    }
   
    // Update password if a new one is provided
    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($request->input('password'))]);
    }
        return redirect()->back()->with('password-success', 'You have successfully change your password');

    }
}
