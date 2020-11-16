<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Comment factory.
        \App\Models\Comment::factory(50)->create();
    }
}
