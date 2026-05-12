<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'entreprise_id',
        'title',
        'description',
        'location',
        'type',
        'is_published',
    ];

    // Get the entreprise that owns the offer.
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Get all applications sent for this offer.
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}
