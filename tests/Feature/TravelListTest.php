<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelListTest extends TestCase
{
    use RefreshDatabase;

    public function test_travels_list_returns_paginated_data_correctly(): void
    {
        //create 31 records
        Travel::factory(31)->create(['is_public' => true]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);

        //check if it returned 15 reocords per page
        $response->assertJsonCount(15, 'data');

        //check if the last page is 3
        $response->assertJsonPath('meta.last_page', 3);
    }

    public function test_travels_show_only_public_records(): void
    {
        //create Travel records
        $publicTravel = Travel::factory()->create(['is_public' => true]);
        Travel::factory()->create(['is_public' => false]);

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);

        //travelcontroller only returns ['is_public' => true], now check if it returning a single record that is true
        $response->assertJsonCount(1, 'data');

        //to assert that a specific JSON path within the response matches an expected value.
        $response->assertJsonPath('data.0.name', $publicTravel->name);
    }
}
