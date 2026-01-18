<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with stats.
     */
    public function index(): View
    {
        $diseaseCount = Disease::count();
        $symptomCount = Symptom::count();
        $ruleCount = Rule::count();

        $latestVersion = \App\Models\KnowledgeBaseVersion::latestVersion();
        $hasPendingChanges = \App\Models\KnowledgeBaseVersion::hasPendingChanges();
        
        return view('dashboard', compact(
            'diseaseCount', 
            'symptomCount', 
            'ruleCount',
            'latestVersion',
            'hasPendingChanges'
        ));
    }
}
