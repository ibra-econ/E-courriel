<?php

namespace App\Models;

use App\Models\User;
use App\Models\Nature;
use App\Models\Document;
use App\Models\Diffusion;
use App\Models\Annotation;
use App\Models\Imputation;
use App\Models\Departement;
use App\Models\Correspondant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courrier extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The departements that belong to the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class)->withPivot('departement_id','courrier_id')->withTimestamps();
    }

    /**
     * Get the nature that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    /**
     * Get the user that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the annotations for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annotations(): BelongsToMany
    {
        return $this->belongsToMany(Annotation::class)->withPivot('annotation_id','courrier_id')->withTimestamps();
    }

    /**
     * Get all of the documents for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the correspondant that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function correspondant(): BelongsTo
    {
        return $this->belongsTo(Correspondant::class);
    }

    /**
     * Get the imputation associated with the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function imputation(): HasOne
    {
        return $this->hasOne(Imputation::class);
    }

        /**
     * Get the affectation associated with the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function affectation(): HasOne
    {
        return $this->hasOne(Affectation::class);
    }

    /**
     * Get all of the diffusions for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diffusions(): HasMany
    {
        return $this->hasMany(Diffusion::class);
    }

}
