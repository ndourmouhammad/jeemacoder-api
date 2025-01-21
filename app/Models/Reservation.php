<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'installation_id',
        'date',
        'heure_debut',
        'heure_fin',
        'statut',
        'prix_total'
    ];

    /**
     * Relation avec l'utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'installation.
     */
    public function installation()
    {
        return $this->belongsTo(Installation::class);
    }
}
