<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diffusion extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * Get the imputation that owns the Diffusion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imputation(): BelongsTo
    {
        return $this->belongsTo(Imputation::class);
    }

    /**
     * Get the courrier that owns the Diffusion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get the departement that owns the Diffusion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Get the user that owns the Diffusion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
