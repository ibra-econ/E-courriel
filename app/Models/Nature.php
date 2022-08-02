<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nature extends Model
{
    use HasFactory;
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }
}
