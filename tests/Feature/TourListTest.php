<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourListTest extends TestCase
{
    use RefreshDatabase;

    public function test_tours_list_by_travel_slug_returns_correct_tours(): void
    {
        $travel = Travel::factory()->create();
        $tour = Tour::factory()->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'. $travel->slug .'/tours');

        $response->assertStatus(200);
        //check if it returned 1 reocords per page
        $response->assertJsonCount(1, 'data');

        // checks whether the JSON response contains the specified key-value pairs
        $response->assertJsonFragment(['id' => $tour->id]);
    }

    public function test_tours_price_is_shown_correctly(): void
    {
        $travel = Travel::factory()->create();
        Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 123.45,
        ]);

        $response = $this->get('/api/v1/travels/'. $travel->slug .'/tours');

        $response->assertStatus(200);
        //check if it returned 1 reocords per page
        $response->assertJsonCount(1, 'data');

        // checks whether the JSON response contains the specified key-value pairs
        $response->assertJsonFragment(['price' => '123.45']);
    }

    public function test_tours_list_returns_pagination(): void
    {
        //create 31 records
        $travel =Travel::factory()->create();
        $tour = Tour::factory()->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'. $travel->slug .'/tours');

        $response->assertStatus(200);

        //check if it returned 15 reocords per page
        $response->assertJsonCount(1, 'data');

        //check if the last page is 3
        $response->assertJsonPath('meta.last_page', 1);
    }
}

