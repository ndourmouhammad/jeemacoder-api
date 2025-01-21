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
            'image' => 'https://img.freepik.com/photos-gratuite/femme-s-entrainant-pour-halterophilie-dans-salle-sport_23-2149278073.jpg?t=st=1737391252~exp=1737394852~hmac=e825ae78d1500c84bc1675aac8dfd8cedd17e7f0584910bb05e08252ba0ed244&w=1380',
        ]);

        Installation::create([
            'libelle' => 'Terrain de sport',
            'adresse' => 'Quartier Nord, Rue 5',
            'description' => 'Un terrain adapté pour le football et le basket-ball.',
            'disponible' => true,
            'prix_par_heure' => 3000,
            'image' => 'https://img.freepik.com/photos-gratuite/homme-afro-jouant-au-basketball-terrain_23-2148264677.jpg?t=st=1737391373~exp=1737394973~hmac=c545331804bbe7dcf12130d28cd7eaf1c8b6ac7ecbbbf29f097451dfb9ba8fcc&w=1380',
        ]);

        Installation::create([
            'libelle' => 'Terrain de tennis',
            'adresse' => 'Quartier Sud, Rue 8',
            'description' => 'Un terrain spacieux pour les amateurs de tennis.',
            'disponible' => false,
            'prix_par_heure' => 2000,
            'image' => 'https://img.freepik.com/photos-gratuite/court-tennis-rendu-3d-illustration_654080-1384.jpg?t=st=1737391617~exp=1737395217~hmac=bf99a7ec55cf5939cba71fb851fa2de03dcae204f04dd1236903399f5f921422&w=1480',
        ]);
    }
}
