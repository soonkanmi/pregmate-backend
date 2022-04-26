<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPregnancyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_concieved',
        'first_trimester_ends',
        'second_trimester_ends',
        'estimated_due_date',
        'delivery_status',
        'actual_delivery_date',
        'mode_of_delivery',
        'is_liveborn',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
