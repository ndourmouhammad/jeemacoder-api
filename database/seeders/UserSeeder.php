<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Mouhammad Ndour',
            'email' => 'ndourmouhammad15@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'adresse' => 'Dakar Plateau, Rue Raffenel',
            'telephone' => '+221 78 103 35 01',
        ]);

        User::create([
            'name' => 'Mbene Dieng',
            'email' => 'senegalenvue@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'adresse' => 'Sonadis, Rufisque, Dakar',
            'telephone' => '+221 00 000 00 00',
        ]);

        User::create([
            'name' => 'Bintou Pouye',
            'email' => 'mou.ndour@isepdiamniadio.edu.sn',
            'password' => Hash::make('password'),
            'role' => 'client',
            'adresse' => 'Dakar Plateau, Rue Raffenel',
            'telephone' => '+221 00 111 11 11',
        ]);
    }
}
