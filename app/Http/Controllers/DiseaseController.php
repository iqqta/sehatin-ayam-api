<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule as ValidationRule;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $diseases = Disease::orderBy('disease_code')->get();
        return view('diseases.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'disease_code' => [
                'required',
                ValidationRule::unique('diseases', 'disease_code')
            ],
            'name' => 'required',
            'description' => 'required',
            'treatment' => 'required',
        ],
        [
            'disease_code.unique' => 'Kode penyakit sudah ada!',
            'disease_code.required' => 'Kode penyakit wajib diisi!',
            'name.required' => 'Nama penyakit wajib diisi!',
            'description.required' => 'Deskripsi penyakit wajib diisi!',
            'treatment.required' => 'Penanganan penyakit wajib diisi!',
        ]
        );

        Disease::create($request->all());

        return redirect()->route('diseases.index')
                        ->with('success', 'Data penyakit berhasil ditambahkan.');
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
    public function update(Request $request, Disease $disease): RedirectResponse
    {
        $request->validate([
            'disease_code' => [
                'required',
                ValidationRule::unique('diseases', 'disease_code')->ignore($disease->disease_code, 'disease_code')
            ],
            'name' => 'required',
            'description' => 'required',
            'treatment' => 'required',
        ],
        [
            'disease_code.unique' => 'Kode penyakit sudah ada!',
            'disease_code.required' => 'Kode penyakit wajib diisi!',
            'name.required' => 'Nama penyakit wajib diisi!',
            'description.required' => 'Deskripsi penyakit wajib diisi!',
            'treatment.required' => 'Penanganan penyakit wajib diisi!',
        ]);

        $disease->update($request->all());

        return redirect()->route('diseases.index')
                        ->with('success', 'Data penyakit berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();

        return redirect()->route('diseases.index')
                        ->with('success', 'Data penyakit berhasil dihapus');
    }
}
