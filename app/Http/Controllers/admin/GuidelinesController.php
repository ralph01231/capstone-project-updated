<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Guidelines;
use App\Models\GuidelinesBefore;
use App\Models\GuidelinesDuring;
use App\Models\GuidelinesAfter;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class GuidelinesController extends Controller
{
    public function index(Request $request)
    {
        $guidelines = Guidelines::select(['guidelines_id', 'guidelines_name', 'created_at'])->get();

        $formattedGuidelines = $guidelines->map(function ($guideline) {
            return [
                'guidelines_id' => $guideline->guidelines_id,
                'guidelines_name' => $guideline->guidelines_name,
                'created_at' => $guideline->created_at->toDateTimeString(),
            ];
        });

        $jsonData = ['data' => $formattedGuidelines];

        if ($request->wantsJson()) {
            return response()->json($jsonData);
        }

        // Return view with data
        return view('admin.guidelines_management.guidelines', $jsonData);
    }

    public function edit(Guidelines $guidelines)
    {
        // Eager load the related data
        $guidelines->load(['before', 'during', 'after']);

        // Fetch the details of the guidelines along with related data
        return response()->json(['data' => $guidelines]);
    }

    public function storeGuidelines(Request $request)
    {
        $request->validate([
            'thumbnail' => [
                'required',
                'file',
            ],
            'before_file' => [
                'required',
                'file',
            ],

            'during_file' => [
                'required',
                'file',
            ],

            'after_file' => [
                'required',
                'file',
            ],
            'guidelines_title' => [
                'required',
            ],
            'disaster_type' => [
                'required',
            ],
            'before_headings' => [
                'required',
            ],
            'before_description' => [
                'required',
            ],
            'during_headings' => [
                'required',
            ],
            'during_description' => [
                'required',
            ],
            'after_headings' => [
                'required',
            ],
            'after_description' => [
                'required',
            ],
        ]);


        $thumbnailFileName = $request->file('thumbnail')->storeAs(
            'file-storage',
            'thumbnail_' . uniqid() . '.' . $request->file('thumbnail')->extension(),
            'public'
        );
        $beforeFileName = $request->file('before_file')->storeAs(
            'file-storage',
            'before_file_' . uniqid() . '.' . $request->file('before_file')->extension(),
            'public'
        );

        $duringFileName = $request->file('during_file')->storeAs(
            'file-storage',
            'during_file_' . uniqid() . '.' . $request->file('during_file')->extension(),
            'public'
        );

        $afterFileName = $request->file('after_file')->storeAs(
            'file-storage',
            'after_file_' . uniqid() . '.' . $request->file('after_file')->extension(),
            'public'
        );



        $guidelines = Guidelines::create([
            'guidelines_name' => $request->input('guidelines_title'),
            'thumbnail' => $thumbnailFileName,
            'disaster_type' => $request->input('disaster_type'),
        ]);

        $before = GuidelinesBefore::create([
            'guidelines_id' => $guidelines->guidelines_id,
            'headings' => $request->input('before_headings'),
            'image' => $beforeFileName,
            'description' => $request->input('before_description'),
        ]);

        $during = GuidelinesDuring::create([
            'guidelines_id' => $guidelines->guidelines_id,
            'headings' => $request->input('during_headings'),
            'image' => $duringFileName,
            'description' => $request->input('during_description'),
        ]);

        $after = GuidelinesAfter::create([
            'guidelines_id' => $guidelines->guidelines_id,
            'headings' => $request->input('after_headings'),
            'image' => $afterFileName,
            'description' => $request->input('after_description'),
        ]);

        $guidelines->before()->save($before);
        $guidelines->during()->save($during);
        $guidelines->after()->save($after);

        return response()->json(['message' => 'Guidelines created successfully']);
    }


    public function updateGuidelines(Request $request, Guidelines $guidelinesID)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file'],
            'before_file' => ['nullable', 'file'],
            'during_file' => ['nullable', 'file'],
            'after_file' => ['nullable', 'file'],
            'guidelines_title' => ['required'],
            'disaster_type' => ['required'],
            'before_headings' => ['required'],
            'before_description' => ['required'],
            'during_headings' => ['required'],
            'during_description' => ['required'],
            'after_headings' => ['required'],
            'after_description' => ['required'],
        ]);

        $guidelinesID->update([
            'guidelines_name' => $request->input('guidelines_title'),
            'disaster_type' => $request->input('disaster_type'),
        ]);

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            if ($guidelinesID->thumbnail) {
                Storage::disk('public')->delete($guidelinesID->thumbnail);
            }

            $thumbnailFileName = 'thumbnail_' . uniqid() . '.' . $request->file('thumbnail')->getClientOriginalExtension();

            $request->file('thumbnail')->storeAs('file-storage', $thumbnailFileName, 'public');

            $guidelinesID->update(['thumbnail' => $thumbnailFileName]);
        }
        $before = $guidelinesID->before;
        $before->update([
            'headings' => $request->input('before_headings'),
            'description' => $request->input('before_description'),
        ]);

        if ($request->hasFile('before_file') && $request->file('before_file')->isValid()) {
            if ($guidelinesID->before->image) {
                Storage::disk('public')->delete($guidelinesID->before->image);
            }
            $beforeFileName = 'before_file_' . uniqid() . '.' . $request->file('before_file')->getClientOriginalExtension();
            $request->file('before_file')->storeAs('file-storage', $beforeFileName, 'public');

            $guidelinesID->before->update(['image' => $beforeFileName]);
        }

        $during = $guidelinesID->during;
        $during->update([
            'headings' => $request->input('during_headings'),
            'description' => $request->input('during_description'),
        ]);

        if ($request->hasFile('during_file') && $request->file('during_file')->isValid()) {
            if ($guidelinesID->during->image) {
                Storage::disk('public')->delete($guidelinesID->during->image);
            }

            $duringFileName = 'during_file_' . uniqid() . '.' . $request->file('during_file')->getClientOriginalExtension();

            $request->file('during_file')->storeAs('file-storage', $duringFileName, 'public');

            $guidelinesID->during->update(['image' => $duringFileName]);
        }

        $after = $guidelinesID->after;
        $after->update([
            'headings' => $request->input('after_headings'),
            'description' => $request->input('after_description'),
        ]);

        if ($request->hasFile('after_file') && $request->file('after_file')->isValid()) {
            if ($guidelinesID->after->image) {
                Storage::disk('public')->delete($guidelinesID->after->image);
            }

            $afterFileName = 'after_file_' . uniqid() . '.' . $request->file('after_file')->getClientOriginalExtension();

            $request->file('after_file')->storeAs('file-storage', $afterFileName, 'public');

            $guidelinesID->after->update(['image' => $afterFileName]);
        }

        return response()->json(['message' => 'Guidelines updated successfully']);
    }
    public function destroy(Request $request, Guidelines $guidelinesID)
    {
        if ($guidelinesID) {
            if ($guidelinesID->thumbnail) {
                Storage::disk('public')->delete($guidelinesID->thumbnail);
            }

            if ($guidelinesID->before && $guidelinesID->before->image) {
                Storage::disk('public')->delete($guidelinesID->before->image);
            }

            if ($guidelinesID->during && $guidelinesID->during->image) {
                Storage::disk('public')->delete($guidelinesID->during->image);
            }

            if ($guidelinesID->after && $guidelinesID->after->image) {
                Storage::disk('public')->delete($guidelinesID->after->image);
            }

            $guidelinesID->delete();

            return response()->json(['message' => 'Guidelines deleted successfully']);
        }

        return response()->json(['error' => 'Guidelines not found'], 404);
    }
}
