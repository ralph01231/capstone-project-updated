<?php

namespace App\Http\Controllers\sector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show(){

        $id = Auth::user()->id;
        $profiledata = User::find($id);        
        
        return view('sector.profile', compact('profiledata'));

    }

    




    public function update(Request $request){
        

        
        $id = Auth::user()->id;
        $userdata = User::find($id);
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $userdata->id,
            'password' => [
                'string',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            ], 
        ]);

        

        
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->password = Hash::make($request->password);
        $userdata ->save();

        // $user->update([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
           
        // ]);

        return redirect()->back()->with('success-bt', 'successfully modified');

    }
}
