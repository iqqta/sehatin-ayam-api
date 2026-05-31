<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_code',
        'name',
        'description',
        'treatment',
    ];

    protected $primaryKey = 'disease_code';
    public $incrementing = false;
    protected $keyType = 'string';

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class, 'disease_code', 'disease_code');
    }
}
