<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'next_of_kin',
        'address',
        'occupation'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
