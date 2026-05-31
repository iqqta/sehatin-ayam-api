<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeVersionRecord extends Model
{
    protected $table = 'knowledge_version_records';
    protected $primaryKey = ['version','disease_code','symptom_code'];
    public $incrementing = false;

    protected $fillable = [
        'version',
        'disease_code',
        'disease_name',
        'disease_description',
        'disease_treatment',
        'symptom_code',
        'symptom_name',
        'mb',
        'md',
    ];

    public $timestamps = false;

    public function knowledgeBaseVersion()
    {
        return $this->belongsTo(KnowledgeBaseVersion::class, 'version', 'version');

    }
}