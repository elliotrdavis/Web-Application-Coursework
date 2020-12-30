<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User factory.
        \App\Models\User::factory(10)->create();


        // Friends factory.
        $friends = \App\Models\User::all();

        \App\Models\User::all()->each(function ($user) use ($friends) {
            $user->friends()->attach(
                $friends->random(rand(1,10))->pluck('id')->toArray()
            );
        });

        // Create admin user
        User::create(
            ['name' => 'Elliot Davis',
            'email' => '959547@swansea.ac.uk',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role_id'=>3,
        ]);

    }
}
