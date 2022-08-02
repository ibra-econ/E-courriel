<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Annotation extends Model
{
    use HasFactory;

    /**
     * The courriers that belong to the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courriers(): BelongsToMany
    {
        return $this->belongsToMany(Courrier::class)->withTimestamps();
    }
}
