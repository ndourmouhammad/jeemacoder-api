<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Reservation::create([
            'user_id' => 2,
            'installation_id' => 1,
            'date' => '2025-01-22',
            'heure_debut' => '10:00:00',
            'heure_fin' => '12:00:00',
            'prix_total' => 10000,
            'statut' => 'confirmee',
        ]);

        Reservation::create([
            'user_id' => 2,
            'installation_id' => 2,
            'date' => '2025-01-23',
            'heure_debut' => '15:00:00',
            'heure_fin' => '17:00:00',
            'prix_total' => 6000,
            'statut' => 'en_attente',
        ]);

        Reservation::create([
            'user_id' => 3,
            'installation_id' => 3,
            'date' => '2025-01-24',
            'heure_debut' => '09:00:00',
            'heure_fin' => '10:30:00',
            'prix_total' => null,
            'statut' => 'annulee',
        ]);
    }
}
