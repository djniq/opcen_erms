<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();   
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => Str::random(10).'@gmail.com',
            'primary_mobile_number' => $faker->numerify('9##########'),
            'password' => Hash::make('password'),
            'role' => 'superAdmin'
        ]);

        DB::table('users')->insert([
            'name' => 'Facility Admin',
            'username' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'primary_mobile_number' => $faker->numerify('9##########'),
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Opcen User',
            'username' => 'opcen',
            'email' => Str::random(10).'@gmail.com',
            'primary_mobile_number' => $faker->numerify('9##########'),
            'password' => Hash::make('password'),
            'role' => 'opcen'
        ]);

        DB::table('users')->insert([
            'name' => 'EMT User',
            'username' => 'emt',
            'primary_mobile_number' => $faker->numerify('9##########'),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'emt'
        ]);
    }
}
