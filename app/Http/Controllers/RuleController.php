<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::with(['disease', 'symptom'])->orderBy('disease_code')->get();
        return view('rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $diseases = Disease::all();
        $symptoms = Symptom::all();
        return view('rules.create', compact('diseases', 'symptoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'disease_code' => [
                'required', 
                'exists:diseases,disease_code',
                ValidationRule::unique('rules')->where(function ($query) use ($request) {
                    return $query->where('disease_code', $request->input('disease_code'))
                                 ->where('symptom_code', $request->input('symptom_code'));
                }),
            ],
            'symptom_code' => [
                'required',
                'exists:symptoms,symptom_code'
            ],
            'mb' => 'required',
            'md' => 'required',
        ],
        [
            'disease_code.unique' => 'Kombinasi Penyakit dan Gejala ini sudah ada!',
            'disease_code.required' => 'Penyakit wajib dipilih!',
            'symptom_code.required' => 'Gejala wajib dipilih!',
            'mb.required' => 'Nilai MB wajib diisi!',
            'md.required' => 'Nilai MD wajib diisi!',
        ]); 

        Rule::create($request->all());
        return redirect()->route('rules.index')
                        ->with('success', 'Aturan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
        return view('rules.show', compact('rule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($disease_code, $symptom_code)
    {
        $rule = Rule::where('disease_code', $disease_code)->where('symptom_code', $symptom_code)->firstOrFail();
        $diseases = Disease::all();
        $symptoms = Symptom::all();
        return view('rules.edit', compact('rule', 'diseases', 'symptoms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $disease_code, $symptom_code)
    {
        $request->validate([
            'disease_code' => [
                'required',
                'exists:diseases,disease_code',
                ValidationRule::unique('rules')->where(function ($query) use ($request, $disease_code, $symptom_code) {
                    return $query->where('disease_code', $request->input('disease_code'))
                                 ->where('symptom_code', $request->input('symptom_code'))
                                 ->whereNot(function ($query) use ($disease_code, $symptom_code) {
                                     $query->where('disease_code', $disease_code)
                                           ->where('symptom_code', $symptom_code);
                                 });
                }),
            ],
            'symptom_code' => [
                'required',
                'exists:symptoms,symptom_code'
            ],
            'mb' => 'required',
            'md' => 'required',
        ],[
            'disease_code.unique' => 'Kombinasi Penyakit dan Gejala ini sudah ada!',
            'disease_code.required' => 'Penyakit wajib dipilih!',
            'symptom_code.required' => 'Gejala wajib dipilih!',
            'mb.required' => 'Nilai MB wajib diisi!',
            'md.required' => 'Nilai MD wajib diisi!',
        ]);

        Rule::where('disease_code', $disease_code)->where('symptom_code', $symptom_code)->update([
            'disease_code' => $request->disease_code,
            'symptom_code' => $request->symptom_code,
            'mb' => $request->mb,
            'md' => $request->md,
        ]);

        return redirect()->route('rules.index')
                        ->with('success', 'Aturan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($disease_code, $symptom_code)
    {
        Rule::where('disease_code', $disease_code)->where('symptom_code', $symptom_code)->delete();

        return redirect()->route('rules.index')
                        ->with('success', 'Aturan berhasil dihapus');
    }
}
