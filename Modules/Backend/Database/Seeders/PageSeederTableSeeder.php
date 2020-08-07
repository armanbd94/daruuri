<?php

namespace Modules\Backend\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Backend\Entities\Page;

class PageSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert([
            ['title' => 'Repair Services For Your Mobile'],
            ['title' => 'Mobile Hardware Repair Solution'],
            ['title' => 'Mobile Software Solution'],
        ]);
    }
}
