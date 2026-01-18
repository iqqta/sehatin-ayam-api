<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diseases = Disease::orderBy('code')->get();
        return view('diseases.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:diseases',
            'name' => 'required',
            'description' => 'required',
        ]);

        Disease::create($request->all());

        return redirect()->route('diseases.index')
                        ->with('success', 'Disease created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disease $disease)
    {
        return view('diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        return view('diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'code' => 'required|unique:diseases,code,'.$disease->id,
            'name' => 'required',
            'description' => 'required',
        ]);

        $disease->update($request->all());

        return redirect()->route('diseases.index')
                        ->with('success', 'Disease updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();

        return redirect()->route('diseases.index')
                        ->with('success', 'Disease deleted successfully');
    }
}
