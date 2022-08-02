<?php

namespace App\Models;

use App\Models\User;
use App\Models\Nature;
use App\Models\Document;
use App\Models\Annotation;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courrier extends Model
{
    use HasFactory;

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
    public function annotations(): HasMany
    {
        return $this->hasMany(Annotation::class);
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
}
