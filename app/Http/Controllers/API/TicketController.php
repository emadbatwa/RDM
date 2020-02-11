<?php

namespace App\Http\Controllers\API;

use App\Classification;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Ticket;
use Illuminate\Http\Request;
use App\Location;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $messages = [
            "photos.max" => "photos can't be more than 4."
        ];

        $request->validate([
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required',
            'neighborhood' => 'required',
            'photos' => 'required | max:4',
            'photos.*' => 'image|mimes:jpg,jpeg',
        ], $messages);

        $location = Location::create([
            'location_url' => 'https://www.google.com/maps/search/?api=1&query=' . $request->latitude . ',' . $request->longitude,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'neighborhood_id' => $request->neighborhood,
            'city_id' => $request->city,
        ]);

        $ticket = Ticket::create([
            'description' => $request->description,
            'user_id' => $request->user()->id,
            'classification_id' => Classification::OTHER,
            'location_id' => $location->id,
        ]);

        if ($photos = $request->file('photos')) {
            foreach ($photos as $photo) {
                $filename = uniqid() . time() . '.' . $photo->extension();
                $photo->move(storage_path('app/public/photos'), $filename);
                Photo::create([
                    'photo_path' => 'http://www.ai-rdm.website/storage/photos/' . $filename,
                    'photo_name' => $filename,
                    'ticket_id' => $ticket->id,
                    'role_id' => 1
                ]);
            }
        }
        return response()->json([
            'message' => 'Successfully added ticket'
        ], 200);
    }

    public function list(Request $request)
    {
        $user = $request->user();
        $tickets = null;
        //user list
        if ($user->role_id == 1) {
            $tickets = Ticket::with('photos')->join('statuses', 'statuses.id', '=', 'tickets.status_id')
                ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
                ->join('locations', 'locations.id', '=', 'tickets.location_id')
                ->join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('tickets.id', 'tickets.description', 'statuses.status')
                ->where('tickets.user_id', '=', $user->id)
                ->orderBy('id')
                ->get();
        }
        //admin list
        if ($user->role_id == 2) {
            $tickets = Ticket::with('photos')->join('statuses', 'statuses.id', '=', 'tickets.status_id')
                ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
                ->join('locations', 'locations.id', '=', 'tickets.location_id')
                ->join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('tickets.id', 'tickets.description', 'statuses.status')
                ->orderBy('id')
                ->get();
            //company list
        }
        if ($user->role_id == 3) {
            $tickets = Ticket::with('photos')->join('statuses', 'statuses.id', '=', 'tickets.status_id')
                ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
                ->join('locations', 'locations.id', '=', 'tickets.location_id')
                ->join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('tickets.id', 'tickets.description', 'statuses.status')
                ->where('tickets.assigned_to', '=', $user->id)
                ->orderBy('id')
                ->get();
        }
        return response()->json($tickets);
    }

    public function update(Request $request)
    {
        $messages = [
            "photos.max" => "photos can't be more than 4."
        ];

        $request->validate([
            'status' => 'required | in: CLOSED, ASSIGNED',
            'photos' => 'max:4',
            'photos.*' => 'image|mimes:jpg,jpeg',
        ], $messages);

    }
}
