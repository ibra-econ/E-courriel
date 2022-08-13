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

class Annotation extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The courriers that belong to the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courriers(): BelongsToMany
    {
        return $this->belongsToMany(Courrier::class)->withPivot('annotation_id','courrier_id')->withTimestamps();
    }

    /**
     * Get the departement that owns the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Get the user that owns the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
