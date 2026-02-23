<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AldarSeeder::class);
        $this->call(PageSectionSeeder::class);
    }
}
