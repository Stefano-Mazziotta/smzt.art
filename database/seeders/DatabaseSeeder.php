<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Location;
use App\Models\Film;
use App\Models\Camera;
use App\Models\Label;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(10)->create();
        Location::factory(10)->create();
        Film::factory(3)->create();
        Camera::factory(4)->create();
        Label::factory(4)->create();
    }
}
