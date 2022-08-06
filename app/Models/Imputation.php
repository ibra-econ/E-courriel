<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Imputation extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * Get the user that owns the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

              /**
     * Get all of the imputations for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class)->withPivot('departement_id','imputation_id')->withTimestamps();
    }

    /**
     * Get the courrier that owns the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }
}
