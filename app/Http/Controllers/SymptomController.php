<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule as ValidationRule;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $symptoms = Symptom::orderBy('symptom_code')->get();
        return view('symptoms.index', compact('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('symptoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'symptom_code' => [
                'required',
                ValidationRule::unique('symptoms', 'symptom_code')
            ],
            'name' => 'required',
        ],[
            'symptom_code.unique' => 'Kode gejala sudah ada!',
            'symptom_code.required' => 'Kode gejala wajib diisi!',
            'name.required' => 'Nama gejala wajib diisi!',
        ]);

        Symptom::create($request->all());

        return redirect()->route('symptoms.index')
                        ->with('success','Symptom created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom): View
    {
        return view('symptoms.edit',compact('symptom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom): RedirectResponse
    {
        $request->validate([
            'symptom_code' => [
                'required',
                ValidationRule::unique('symptoms', 'symptom_code')->ignore($symptom->symptom_code, 'symptom_code')
            ],
            'name' => 'required',
        ],
        [
            'symptom_code.unique' => 'Kode gejala sudah ada!',
            'symptom_code.required' => 'Kode gejala wajib diisi!',
            'name.required' => 'Nama gejala wajib diisi!',
        ]);

        $symptom->update($request->all());

        return redirect()->route('symptoms.index')
                        ->with('success','Symptom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom): RedirectResponse
    {
        $symptom->delete();

        return redirect()->route('symptoms.index')
                        ->with('success','Gejala berhasil dihapus');
    }
}
