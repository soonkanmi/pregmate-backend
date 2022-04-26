<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserObstetricalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'previous_pregnancies',
        'liveborns',
        'stillborns',
        'previous_mode_of_delivery'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
