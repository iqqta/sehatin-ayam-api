<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBaseVersion;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\Rule;
use App\Models\KnowledgeVersionRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublishUpdateController extends Controller
{
    /**
     * Store a new knowledge base version and record.
     */
    public function store()
    {
        if (!KnowledgeBaseVersion::hasPendingChanges()) {
            return back()->with('error', 'Tidak ada perubahan yang perlu dirilis.');
        }

        return DB::transaction(function () {
        
        $latestVersion = KnowledgeBaseVersion::latestVersion();
        $newVersionNumber = $latestVersion ? $latestVersion->version + 1 : 1;

        // Head versi
        $publishedAt = collect([
            Disease::max('updated_at'),
            Symptom::max('updated_at'),
            Rule::max('updated_at'),
        ])->filter()->max();

        $version = KnowledgeBaseVersion::create([
            'version'        => $newVersionNumber,
            'published_at'   => $publishedAt ?: now(),
            'published_by'   => Auth::user()->username,
            'diseases_count' => Disease::count(),
            'symptoms_count' => Symptom::count(),
            'rules_count'    => Rule::count(),
        ]);

        // Ambil master data melalui query join
        $records = DB::table('rules')
            ->join('diseases', 'rules.disease_code', '=', 'diseases.disease_code')
            ->join('symptoms', 'rules.symptom_code', '=', 'symptoms.symptom_code')
            ->select([
                'diseases.disease_code', 
                'diseases.name as d_name',
                'diseases.description as d_desc',
                'diseases.treatment as d_treatment',
                'symptoms.symptom_code', 
                'symptoms.name as s_name',
                'rules.mb', 
                'rules.md'
            ])->get();

        // Simpan records
        foreach ($records as $record) {
            KnowledgeVersionRecord::create([
                'version'             => $newVersionNumber,
                'disease_code'        => $record->disease_code,
                'disease_name'        => $record->d_name,
                'disease_description' => $record->d_desc,
                'disease_treatment'   => $record->d_treatment,
                'symptom_code'        => $record->symptom_code,
                'symptom_name'        => $record->s_name,
                'mb'                  => $record->mb,
                'md'                  => $record->md,
            ]);
        }

            return back()->with('success', "Knowledge base updated to version {$newVersionNumber}.");
        });
    }

    public function checkIntegrity()
{
    $diseaseWithoutRules = Disease::doesntHave('rules')->get();
    $symptomWithoutRules = Symptom::doesntHave('rules')->get();

    if ($diseaseWithoutRules->isNotEmpty() || $symptomWithoutRules->isNotEmpty()) {
        $details = [];
        if($diseaseWithoutRules->isNotEmpty()) $details[] = "Penyakit: " . $diseaseWithoutRules->pluck('name')->implode(', ');
        if($symptomWithoutRules->isNotEmpty()) $details[] = "Gejala: " . $symptomWithoutRules->pluck('name')->implode(', ');

        return response()->json([
            'status' => 'error',
            'message' => 'Terdapat data penyakit atau gejala yang belum memiliki aturan.',
            'details' => implode(' | ', $details) // Ini agar x-text="errorMessage" tampil benar
        ]);
    }

    return response()->json(['status' => 'success']);
}
}
