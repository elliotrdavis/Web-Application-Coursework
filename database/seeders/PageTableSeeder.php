<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

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
        //\App\Models\Page::factory(4)->create();

        Page::create(
            ['title' => 'White Water',
            'description' => 'A page to talk about all things white water related',
        ]);

        Page::create(
            ['title' => 'Canoe Slalom',
            'description' => 'A page to talk about all things canoe slalom related',
        ]);

        Page::create(
            ['title' => 'Canoe Polo',
            'description' => 'A page to talk about all things canoe polo related',
        ]);

        Page::create(
            ['title' => 'Canoe Slalom',
            'description' => 'A page to talk anything off topic',
        ]);
    }
}
