<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KnowledgeBaseVersion extends Model
{
    protected $primaryKey = 'version';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'version',
        'published_at',
        'diseases_count',
        'symptoms_count',
        'rules_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'diseases_count' => 'integer',
        'symptoms_count' => 'integer',
        'rules_count' => 'integer',
        'version' => 'integer',
    ];

    public static function latestVersion()
    {
        return self::orderByDesc('version')->first();
    }

    public static function hasPendingChanges()
    {
        $latest = self::latestVersion();
        
        if (!$latest) {
            return Disease::exists() || Symptom::exists() || Rule::exists();
        }

        // Pengecekan jumlah tiap data
        if ((int) Disease::count() !== $latest->diseases_count) return true;
        if ((int) Symptom::count() !== $latest->symptoms_count) return true;
        if ((int) Rule::count() !== $latest->rules_count) return true;

        // Pengecekan perubahan data berdasarkan update
        $lastPublished = $latest->published_at;
        
        $tables = ['diseases', 'symptoms', 'rules'];
        
        foreach ($tables as $table) {
            $latestUpdate = DB::table($table)->max('updated_at');
            if ($latestUpdate && \Carbon\Carbon::parse($latestUpdate)->gt($lastPublished)) {
                return true;
            }
        }
        return false;
    }
}
