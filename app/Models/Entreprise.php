<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{   
    protected $fillable = [
    'user_id',
    'name',
    'email',
    'phone',
    'address',
    'description'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offres()
    {
    return $this->hasMany(Offre::class);
    }
}
