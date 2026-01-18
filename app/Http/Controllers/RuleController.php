<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rule::with(['disease', 'symptom'])->orderBy('disease_id')->get();
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
            'disease_id' => 'required|exists:diseases,id',
            'symptom_id' => 'required|exists:symptoms,id',
            'mb' => 'required|numeric|between:0,1',
            'md' => 'required|numeric|between:0,1',
        ]);

        Rule::create($request->all());

        return redirect()->route('rules.index')
                        ->with('success', 'Rule created successfully.');
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
    public function edit(Rule $rule)
    {
        $diseases = Disease::all();
        $symptoms = Symptom::all();
        return view('rules.edit', compact('rule', 'diseases', 'symptoms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'symptom_id' => 'required|exists:symptoms,id',
            'mb' => 'required|numeric|between:0,1',
            'md' => 'required|numeric|between:0,1',
        ]);

        $rule->update($request->all());

        return redirect()->route('rules.index')
                        ->with('success', 'Rule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rule $rule)
    {
        $rule->delete();

        return redirect()->route('rules.index')
                        ->with('success', 'Rule deleted successfully');
    }
}
