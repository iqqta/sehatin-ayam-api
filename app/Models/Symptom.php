<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    protected $fillable = [
        'symptom_code',
        'name',
    ];

    protected $primaryKey = 'symptom_code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function rules()
    {
        return $this->hasMany(Rule::class, 'symptom_code', 'symptom_code');
    }
}
