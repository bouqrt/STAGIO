<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = [
        'user_id',
        'offre_id',
        'cv',
        'status',
    ];

    // Get the student who applied.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get the offer linked to the application.
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}
