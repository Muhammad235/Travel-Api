<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create user record
        // User::factory(10)->create();

        // First, create 10 travel records
        Travel::factory()->create(['slug' => 'slug-title']);

        // Then, create 10 tour records and associate each one with a random travel record
        Tour::factory()->create([
            'travel_id' => function () {
                return Travel::latest()->first()->id;
            },
        ]);
    }
}
