<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Inserting the default admin
        DB::table('users')->insert([
            'name' => 'thomas',
            'surname' => 'frey',
            'email' => 'frey_work@tutanota.com',
            'password' => Hash::make('password'),
            'access' => 'admin'
        ]);
    }
}
