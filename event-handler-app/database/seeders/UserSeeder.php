<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'place_of_birth' => 'Szeged',
        ]);
        DB::table('user')->insert([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password'),
            'place_of_birth' => 'Szeged',
        ]);
        DB::table('user')->insert([
            'name' => 'Flex Elek',
            'email' => 'flex.elek@example.com',
            'password' => Hash::make('password'),
            'place_of_birth' => 'Szeged',
        ]);
    }
}
