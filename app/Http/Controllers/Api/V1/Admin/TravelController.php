<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;

class TravelController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request)
    {
        // $request->validated();

        $travel = Travel::create($request->validated());

        return new TravelResource($travel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel)
    {
       $updatedTravel =  $travel->update($request->validated());

       return new TravelResource($updatedTravel);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
