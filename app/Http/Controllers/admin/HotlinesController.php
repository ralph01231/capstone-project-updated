<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hotline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;




class HotlinesController extends Controller
{
    public function index(Request $request)
    {
        $hotlines = Hotline::select(['hotlines_id', 'hotlines_number', 'userfrom', 'responder_name'])->get();

        $formattedHotlines = $hotlines->map(function ($hotline) {
            return [
                'hotlines_id' => $hotline->hotlines_id,
                'hotlines_number' => $hotline->hotlines_number,
                'userfrom' => $hotline->userfrom,
                'responder_name' => $hotline->responder_name,
            ];
        });

        $jsonData = ['data' => $formattedHotlines];
        if ($request->wantsJson()) {
            return response()->json($jsonData);
        }

        // Return view with data
        return view('admin.contacts', $jsonData);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotline_number' => 'required',
            'user_from' => 'required',
        ]);

        $user = Auth::user();

        // Create a new Hotline instance and populate fields
        $hotline = new Hotline;
        $hotline->hotlines_number = $request->input('hotline_number');
        $hotline->userfrom = $request->input('user_from');
        $hotline->responder_id = $user->id;
        $hotline->responder_name = $user->responder_name;

        // Save the hotline record
        $hotline->save();
        $hotline->save();

        return response()->json(['message' => 'Hotline added successfully', 'success' => true]);
    }

    public function edit(Hotline $hotline)
    {
        // Fetch the details of the hotline
        return response()->json(['data' => $hotline]);
    }

    public function update(Request $request, Hotline $hotline)
    {
        // Validate the request data
        $request->validate([
            'hotline_number' => 'required',
            'user_from' => 'required',
            // Add validation rules for other fields as needed
        ]);

        // Update the hotline with the new data
        $hotline->update([
            'hotlines_number' => $request->input('hotline_number'),
            'userfrom' => $request->input('user_from'),
            // Update other fields as needed
        ]);

        // Return a response, redirect, or perform any other necessary actions
        return response()->json(['message' => 'Hotline updated successfully']);
    }
    public function destroy(Hotline $hotline)
    {
        try {
            $hotline->delete();

            return response()->json(['message' => 'Hotline deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete hotline'], 500);
        }
    }
}
