<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
        'status',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeIsUser($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeIsDoctor($query)
    {
        return $query->where('role', 'doctor');
    }

    public function scopeIsAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function personal_information(): HasOne
    {
        return $this->hasOne(UserPersonalInformation::class);
    }

    public function obstetrical_information(): HasOne
    {
        return $this->hasOne(UserObstetricalInformation::class);
    }

    public function medical_information(): HasOne
    {
        return $this->hasOne(UserMedicalInformation::class);
    }

    public function pregnancy_information(): HasOne
    {
        return $this->hasOne(UserPregnancyInfo::class);
    }

    public function vitals(): HasMany
    {
        return $this->hasMany(UserVital::class);
    }
}
