<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Diffusion;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
   * Get the departement that owns the Imputation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function departement(): BelongsTo
  {
      return $this->belongsTo(Departement::class);
  }

    /**
     * Get all of the diffusions for the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diffusions(): HasMany
    {
        return $this->hasMany(Diffusion::class);
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
