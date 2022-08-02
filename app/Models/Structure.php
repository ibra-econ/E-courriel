<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;
    /**
     * Get all of the users for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function users(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }
}
