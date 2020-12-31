<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;

class PhoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phone::create(['user_id' => 1]);
        Phone::create(['user_id' => 2]);
        Phone::create(['user_id' => 3]);
        Phone::create(['user_id' => 4]);
        Phone::create(['user_id' => 5]);
        Phone::create(['user_id' => 6]);
        Phone::create(['user_id' => 7]);
        Phone::create(['user_id' => 8]);
        Phone::create(['user_id' => 9]);
        Phone::create(['user_id' => 10]);
        Phone::create(['user_id' => 11]);
    }
}
