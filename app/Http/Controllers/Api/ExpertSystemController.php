<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Http\Request;

class ExpertSystemController extends Controller
{
    public function sync(Request $request)
    {
        $currentVersion = $request->query('current_version');
        $serverVersion = \App\Models\KnowledgeBaseVersion::latestVersion();

        // Jika belum ada versi yg di-publish sama sekali
        if (!$serverVersion) {
            return response()->json([
                'status' => 'uptodate',
                'message' => 'No published version available.',
                'version' => 0
            ]);
        }

        // Jika client mengirim versi, dan versinya sama dengan server
        if ($currentVersion !== null && (int)$currentVersion >= $serverVersion->version) {
            return response()->json([
                'status' => 'uptodate',
                'version' => $serverVersion->version
            ]);
        }

        // Jika client butuh update (versi server > client) atau request pertama kali
        $diseases = Disease::with('rules.symptom')->get()->map(function ($disease) {
            return [
                'code' => $disease->code,
                'name' => $disease->name,
                'description' => $disease->description,
                'createdAt' => $disease->created_at,
                'updatedAt' => $disease->updated_at,
            ];
        });

        $symptoms = Symptom::all()->map(function ($symptom) {
            return [
                'code' => $symptom->code,
                'name' => $symptom->name,
                'createdAt' => $symptom->created_at,
                'updatedAt' => $symptom->updated_at,
            ];
        });

        $rules = Rule::with(['disease', 'symptom'])->get()->map(function ($rule) {
            return [
                'diseaseCode' => $rule->disease->code,
                'symptomCode' => $rule->symptom->code,
                'mb' => $rule->mb,
                'md' => $rule->md,
                'createdAt' => $rule->created_at,
                'updatedAt' => $rule->updated_at,
            ];
        });

        $treatments = \App\Models\Treatment::with('disease')->get()->map(function ($treatment) {
            return [
                'diseaseCode' => $treatment->disease->code,
                'treat' => $treatment->treat,
                'createdAt' => $treatment->created_at,
                'updatedAt' => $treatment->updated_at,
            ];
        });

        return response()->json([
            'status' => 'new_update_available',
            'version' => $serverVersion->version,
            'publishedAt' => $serverVersion->published_at,
            'data' => [
                'diseases' => $diseases,
                'symptoms' => $symptoms,
                'rules' => $rules,
                'treatments' => $treatments,
            ]
        ]);
    }
}
