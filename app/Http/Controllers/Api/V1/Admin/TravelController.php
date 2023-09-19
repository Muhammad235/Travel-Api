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

        // return "hello";

        // dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
