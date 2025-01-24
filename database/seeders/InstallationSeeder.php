<?php

namespace Database\Seeders;

use App\Models\Installation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Installation::create([
            'libelle' => 'Salle de musuculation',
            'adresse' => 'Centre-ville, Rue 12',
            'description' => 'Une salle spacieuse pour les amateurs de musculation.',
            'disponible' => true,
            'prix_par_heure' => 5000,
            'image' => 'https://i.pinimg.com/1200x/2c/95/04/2c950449e232b0b256b4df6dab6ea961.jpg',
        ]);

        Installation::create([
            'libelle' => 'Terrain de sport',
            'adresse' => 'Quartier Nord, Rue 5',
            'description' => 'Un terrain adapté pour le football et le basket-ball.',
            'disponible' => true,
            'prix_par_heure' => 3000,
            'image' => 'https://i.pinimg.com/1200x/d7/e4/13/d7e4130df004fd3c31f1af903db8f245.jpg',
        ]);

        Installation::create([
            'libelle' => 'Terrain de tennis',
            'adresse' => 'Quartier Sud, Rue 8',
            'description' => 'Un terrain spacieux pour les amateurs de tennis.',
            'disponible' => false,
            'prix_par_heure' => 2000,
            'image' => 'https://i.pinimg.com/1200x/2c/df/a6/2cdfa6a80448e1cf824de78ce19c6171.jpg',
        ]);
    }
}
