<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Courrier;
use App\Models\Imputation;
use App\Models\Departement;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'poste',
        'photo',
        'departement_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the structure that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function structure(): BelongsTo
    // {
    //     return $this->belongsTo(Structure::class);
    // }

    /**
     * Get all of the courriers for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }

    /**
     * Get the departement that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

        /**
     * Get all of the imputations for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imputations(): HasMany
    {
        return $this->hasMany(Imputation::class);
    }
}
