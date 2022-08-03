<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Imputation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departement extends Model
{
    use HasFactory;
/**
 * The courriers that belong to the Departement
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function courriers(): BelongsToMany
{
    return $this->belongsToMany(Courrier::class)->withPivot('departement_id','courrier_id')->withTimestamps();
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
     * Get all of the imputations for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Imputation::class)->withPivot('departement_id','imputation_id')->withTimestamps();
    }
}
