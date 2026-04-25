<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Models\Venue;
use Inertia\Inertia;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::all();
          return Inertia::render('Venues/Index', [
        'venues' => Venue::all()
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        $validated = $request->validate([
        'venue_name' => 'required|string|max:255',
        'venue_address' => 'required|string|max:255',
        'venue_max_capacity' => 'required|integer|min:1',
    ]);

    Venue::create($validated);

    return redirect()->route('venues.index')
        ->with('message', 'Venue created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
         return Inertia::render('Venues/Show', [
        'venue' => $venue
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->validated());
        return response()->json($venue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return response()->json(['message' => 'Venue deleted successfully'], 200);
    }

    public function create()
    {
        return Inertia::render('Venues/Create');
    }

}
