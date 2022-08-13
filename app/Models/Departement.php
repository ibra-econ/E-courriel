<?php

namespace App\Models;

use App\Models\User;
use App\Models\Poste;
use App\Models\Courrier;
use App\Models\Diffusion;
use App\Models\Annotation;
use App\Models\Imputation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departement extends Model
{
    use HasFactory, SoftDeletes;

/**
 * The courriers that belong to the Departement
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
    public function courriers(): BelongsToMany
    {
        return $this->belongsToMany(Courrier::class)->withPivot('departement_id', 'courrier_id')->withTimestamps();
    }

    /**
     * Get all of the users for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

/**
 * Get the imputation associated with the Departement
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
    public function imputation(): HasOne
    {
        return $this->hasOne(Imputation::class);
    }

    /**
     * Get all of the annotations for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annotations(): HasMany
    {
        return $this->hasMany(Annotation::class);
    }

    /**
     * Get all of the postes for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postes(): HasMany
    {
        return $this->hasMany(Poste::class);
    }

    /**
     * Get all of the di for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diffusions(): HasMany
    {
        return $this->hasMany(Diffusion::class);
    }
}
