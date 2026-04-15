<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    public function entreprise()
    {
    return $this->belongsTo(Entreprise::class);
    }
}
