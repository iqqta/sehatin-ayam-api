<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KnowledgeBaseVersion extends Model
{
    protected $fillable = [
        'version',
        'published_at',
        'created_by',
        'diseases_count',
        'symptoms_count',
        'rules_count',
        'treatments_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function latestVersion()
    {
        return self::latest('version')->first();
    }

    public static function hasPendingChanges()
    {
        $latest = self::latestVersion();
        
        if (!$latest) {
            // If no version exists yet, check if there's any data to publish
            return Disease::exists() || Symptom::exists() || Rule::exists() || Treatment::exists();
        }

        // Check if row counts have changed (detects additions AND deletions)
        if (Disease::count() !== $latest->diseases_count) return true;
        if (Symptom::count() !== $latest->symptoms_count) return true;
        if (Rule::count() !== $latest->rules_count) return true;
        if (Treatment::count() !== $latest->treatments_count) return true;

        // Check if any records were updated after last publish
        $lastPublished = $latest->published_at;
        
        $tables = ['diseases', 'symptoms', 'rules', 'treatments'];
        
        foreach ($tables as $table) {
            $latestUpdate = DB::table($table)->max('updated_at');
            if ($latestUpdate && $latestUpdate > $lastPublished) {
                return true;
            }
        }

        return false;
    }
}
