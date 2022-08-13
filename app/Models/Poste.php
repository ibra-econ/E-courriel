<?php

namespace App\Models;

use App\Models\User;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poste extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * Get the user associated with the Poste
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the departement that owns the Poste
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }
}
