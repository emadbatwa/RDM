<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Http\Request;
use App\Location;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'photos' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required|in:USER,BOUTIQUE',
            'neighborhood' => 'required|in:USER,BOUTIQUE',
        ]);

        $location = Location::create([
            'location_url' => $request->location_url,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'neighborhood_id' => $request->neighborhood_id,
            'city_id' => $request->city_id,
        ]);

        $ticket = Ticket::create([
            'description' => $request->description,
            'user_id' => $request->user()->id,
            'classification_id' => $request->classification,
            'location_id' => $location->id,
        ]);
    }
}
