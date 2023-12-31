<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;

class TourController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TourRequest $request, Travel $travel)
    {

        $tour = $travel->tours()->create($request->validated());

        return new TourResource($tour);

    }
}
