<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error-msg', 'User not found');
        }

        $request->validate([
            'current_password' => [
                'required',
                'string',
                'min:8',
                
            ],

            'password' => [
                'required',
                'string', 'confirmed',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols(),
                Rule::notIn([$request->current_password])
            ],
            'confirm_password' => 'required_with:password|string|min:8',

        ]);

        if ($request->filled('current_password')) {
            if (!isset($user->password) || !Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->with('error-msg', 'Your current password is incorrect');
            }
        }

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->input('password'))]);
        }

        return redirect()->back()->with('password-success', 'You have successfully changed your password');
    }
}
