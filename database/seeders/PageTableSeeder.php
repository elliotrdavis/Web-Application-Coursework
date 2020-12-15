<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create page factory.
        \App\Models\Page::factory(4)->create();
    }
}
