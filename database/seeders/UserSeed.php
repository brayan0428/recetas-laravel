<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Brayan Llanos', 
            'email' => 'brayan0428@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/brayan0428',
            'created_at' => now(), 
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'Brayan Llanos Hoyos', 
            'email' => 'brayan042897@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://github.com/brayan0428',
            'created_at' => now(), 
            'updated_at' => now()
        ]);
    }
}
