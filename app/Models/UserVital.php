<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserVital extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'temperature',
        'fluid_intake',
        'drug_intake'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
