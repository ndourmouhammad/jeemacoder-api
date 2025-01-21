<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    protected $fillable = [
        'libelle',
        'adresse',
        'description',
        'disponible',
        'prix_par_heure',
        'image',
    ];

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

}
