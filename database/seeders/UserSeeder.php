<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            [
                'name' => 'Member',
                'gender' => 'F',
                'address' => 'Jl. Bukit Golf Barat 1 Blok QG',
                'email' => 'member@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'member',
            ],
            [
                'name' => 'Administrator',
                'gender' => 'M',
                'address' => 'DY.ID Headquarters',
                'email' => 'admin@dy.id',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ],
        ]);
    }
}
