<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TravelDataSeeder;  // Import the TravelDataSeeder class
// use Database\Seeders\RollbackTravelDataSeeder;  // Import the TravelDataSeeder class

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call(TravelDataSeeder::class);
}
}
