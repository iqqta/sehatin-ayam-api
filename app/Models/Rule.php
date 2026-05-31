<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_code',
        'symptom_code',
        'mb',
        'md',
    ];

    protected $primaryKey = ['disease_code', 'symptom_code'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_code', 'disease_code');
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_code', 'symptom_code');
    }
}
