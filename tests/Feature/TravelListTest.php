<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TravelListTest extends TestCase
{
    use RefreshDatabase;

    public function test_travels_list_returns_paginated_data_correctly(): void
    {

        $response = $this->get('/api/v1/travels');

        $response->assertStatus(200);
    }
}
