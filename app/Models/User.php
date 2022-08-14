<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Poste;
use App\Models\Journal;
use App\Models\Courrier;
use App\Models\Diffusion;
use App\Models\Annotation;
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
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'departement_id',
        'poste',
        'role',
        'photo',
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

    // verification role
    public function isAdmin(){
        return $this->role === 'admin';
    }

    public function isAgent(){
        return $this->role === 'agent';
    }

    public function isSuperuser(){
        return $this->role === 'superuser';
    }

    public function isSecretaire(){
        return $this->role === 'secretaire';
    }

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

    /**
     * Get all of the journals for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    /**
     * Get all of the annotations for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annotations(): HasMany
    {
        return $this->hasMany(Annotation::class);
    }

    /**
     * Get all of the diffusons for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diffusons(): HasMany
    {
        return $this->hasMany(Diffusion::class);
    }
}
