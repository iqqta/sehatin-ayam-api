<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBaseVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublishUpdateController extends Controller
{
    /**
     * Store a new knowledge base version (publish update).
     */
    public function store(Request $request)
    {
        if (!KnowledgeBaseVersion::hasPendingChanges()) {
            return back()->with('error', 'No pending changes to publish.');
        }

        $latestVersion = KnowledgeBaseVersion::latestVersion();
        $newVersionNumber = $latestVersion ? $latestVersion->version + 1 : 1;

        KnowledgeBaseVersion::create([
            'version' => $newVersionNumber,
            'published_at' => now(),
            'created_by' => Auth::id(),
            'diseases_count' => \App\Models\Disease::count(),
            'symptoms_count' => \App\Models\Symptom::count(),
            'rules_count' => \App\Models\Rule::count(),
            'treatments_count' => \App\Models\Treatment::count(),
        ]);

        return back()->with('success', "Knowledge base updated to version {$newVersionNumber}.");
    }
}
