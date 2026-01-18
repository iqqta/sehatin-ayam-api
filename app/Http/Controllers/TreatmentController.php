<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch treatments ordered by disease first (to keep grouping consistent) or just all
        // Then group by disease_id so we can iterate easily in the view
        $treatments = Treatment::with('disease')
            ->orderBy('disease_id')
            ->get()
            ->groupBy('disease_id');
            
        return view('treatments.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diseases = Disease::all();
        return view('treatments.create', compact('diseases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'treat' => 'required|string',
        ]);

        Treatment::create($request->all());

        return redirect()->route('treatments.index')
            ->with('success', 'Penanganan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        $diseases = Disease::all();
        return view('treatments.edit', compact('treatment', 'diseases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'treat' => 'required|string',
        ]);

        $treatment->update($request->all());

        return redirect()->route('treatments.index')
            ->with('success', 'Penanganan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('treatments.index')
            ->with('success', 'Penanganan berhasil dihapus.');
    }
}
