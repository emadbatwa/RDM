<?php

namespace App\Http\Controllers\API;

use App\City;
use App\Classification;
use App\Http\Controllers\Controller;
use App\Neighborhood;
use App\Photo;
use App\Status;
use App\Ticket;
use App\TicketHistory;
use App\User;
use App\UserRating;
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
            'description' => 'string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'city' => 'required',
            'neighborhood' => 'required',
            'photos' => 'required | max:4',
            'photos.*' => 'image|mimes:jpg,jpeg',
        ], $messages);

        $city = City::find($request->city);
        $neighborhood = Neighborhood::find($request->neighborhood);
        if ($neighborhood->city_id == $city->id && $request->user()->role_id == 1) {
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
        return response()->json([
            'message' => 'neighborhood is not in the same city, or the user is not a normal user'
        ], 400);
    }

    public function list(Request $request)
    {
        $user = $request->user();
        $tickets = Ticket::with('photos')->join('statuses', 'statuses.id', '=', 'tickets.status_id')
            ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
            ->join('locations', 'locations.id', '=', 'tickets.location_id')
            ->join('cities', 'cities.id', '=', 'locations.city_id')
            ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id');
        //user list
        if ($user->role_id == 1) {
            $tickets = $tickets->select('tickets.id', 'tickets.description', 'statuses.status')
                ->where('tickets.user_id', '=', $user->id)
                ->orderBy('id')
                ->get();
        }
        //admin list
        if ($user->role_id == 2) {
            $tickets = $tickets->select('tickets.id', 'tickets.description', 'statuses.status')
                ->orderBy('id')
                ->get();
        }
        //company list
        if ($user->role_id == 3) {
            $tickets = $tickets->select('tickets.id', 'tickets.description', 'statuses.status')
                ->where('tickets.assigned_company', '=', $user->id)
                ->orderBy('id')
                ->get();
        }

        //employee list
        if ($user->role_id == 4) {
            $tickets = $tickets->select('tickets.id', 'tickets.description', 'statuses.status')
                ->where('tickets.assigned_employee', '=', $user->id)
                ->orderBy('id')
                ->get();
        }
        return response()->json($tickets);
    }

    public function show(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required | numeric',
        ]);
        $wantedTicket = Ticket::find($request->ticket_id);
        $ticket = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
            ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
            ->where('tickets.id', '=', $wantedTicket->id)
            ->select('tickets.id', 'tickets.description', 'statuses.status', 'classifications.classification')
            ->get();

        $location = Location::join('cities', 'cities.id', '=', 'locations.city_id')
            ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
            ->select('locations.id', 'locations.location_url', 'locations.latitude', 'locations.longitude', 'cities.name_ar as city', 'neighborhoods.name_ar as neighborhood')
            ->where('locations.id', '=', $wantedTicket->location_id)->get();

        $photos = Photo::where('ticket_id', '=', $wantedTicket->id)->get();

        $ticketHistories = TicketHistory::where('ticket_id', '=', $wantedTicket->id)->get();


        return response()->json([
            'ticket' => $ticket[0],
            'location' => $location[0],
            'photos' => $photos,
            'ticketHistories' => $ticketHistories,
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required | numeric',
        ]);

        if ($request->user()->role_id == 2 && $request->status == Status::ASSIGNED) {
            $request->validate([
                'company_id' => 'required | numeric',
                'massage' => 'string',
            ]);

            $ticket = Ticket::find($request->ticket_id);
            $company = User::find($request->company_id);

            if ($company->role_id == 3 && $ticket->assigned_company == null && $ticket->status->id == 1 || $ticket->status->id == 5) {
                if ($ticket->status->id == 1) {
                    $ticket->update(['assigned_company' => $company->id, 'status_id' => 2]);
                }
                //need to implement a way to delete the photo from storage or not?
                Photo::where('ticket_id', '=', $ticket->id)->where('role_id', '=', 3)->delete();
                if ($massage = $request->massage) {
                    TicketHistory::create([
                        'massage' => $massage,
                        'sender' => 1,
                        'receiver' => $company->id,
                        'ticket_id' => $ticket->id,
                    ]);
                }
                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not admin, or the ticket already assigned'
                ], 400);
            }
        }

        if ($request->user()->role_id == 3 && $request->status == Status::IN_PROGRESS) {
            $request->validate([
                'employee_id' => 'required | numeric',
            ]);

            $ticket = Ticket::find($request->ticket_id);
            $employee = User::find($request->employee_id);

            if ($employee->role_id == 4 && $ticket->assigned_employee == null && $ticket->status->id == 2 || $ticket->status->id == 4) {
                if ($ticket->status->id == 2) {
                    $ticket->update(['assigned_employee' => $employee->id, 'status_id' => 3]);
                }
                //need to implement a way to delete the photo from storage or not?
                Photo::where('ticket_id', '=', $ticket->id)->where('role_id', '=', 3)->delete();

                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not company, or the ticket already in progress'
                ], 400);
            }
        }

        if ($request->user()->role_id == 4 && $request->status == Status::SOLVED) {
            $messages = [
                "photos.max" => "photos can't be more than 4."
            ];

            $request->validate([
                'photos' => 'required | max:4',
                'photos.*' => 'image|mimes:jpg,jpeg',
            ], $messages);
            $ticket = Ticket::find($request->ticket_id);
            $employee = $request->user();

            if ($ticket->assigned_employee == $employee->id && $ticket->assigned_company == $employee->company && $ticket->status->id == 3 && $photos = $request->file('photos')) {
                $ticket->update(['status_id' => 4]);
                foreach ($photos as $photo) {
                    $filename = uniqid() . time() . '.' . $photo->extension();
                    $photo->move(storage_path('app/public/photos'), $filename);
                    Photo::create([
                        'photo_path' => 'http://www.ai-rdm.website/storage/photos/' . $filename,
                        'photo_name' => $filename,
                        'ticket_id' => $ticket->id,
                        'role_id' => 3
                    ]);
                }
                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not employee the assigned employee, or the ticket already solved'
                ], 400);
            }
        }

        if ($request->user()->role_id == 3 && $request->status == Status::DONE) {
            $request->validate([
                'massage' => 'string',
            ]);

            $ticket = Ticket::find($request->ticket_id);
            $company = $request->user();

            if ($ticket->assigned_company == $company->id && $ticket->status->id == 4) {
                $ticket->update(['status_id' => 5]);
                if ($massage = $request->massage) {
                    TicketHistory::create([
                        'massage' => $massage,
                        'sender' => $request->user()->id,
                        'receiver' => 1,
                        'ticket_id' => $ticket->id,
                    ]);
                }
                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not admin, or the ticket already assigned'
                ], 400);
            }
        }

        if ($request->user()->role_id == 2 && $request->status == Status::CLOSED) {

            $ticket = Ticket::find($request->ticket_id);

            if ($ticket->status->id == 5) {
                $ticket->update(['status_id' => 6]);

                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not admin, or the ticket already assigned'
                ], 400);
            }
        }

        if ($request->user()->role_id == 2 && $request->status == Status::EXCLUDED) {

            $ticket = Ticket::find($request->ticket_id);

            if ($ticket->status->id == 1) {
                $ticket->update(['status_id' => 7]);

                return response()->json([
                    'message' => 'Successfully updated ticket'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'either the user is not admin, or the ticket already assigned'
                ], 400);
            }
        }


        return response()->json([
            'message' => 'Something went wrong!!'
        ], 400);
    }

    public function rate(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required | numeric',
        ]);

        $user = $request->user();
        $ticket = Ticket::find($request->ticket_id);
        if ($user->role_id == 1 && $ticket->user_rating_id == null) {
            $request->validate([
                'comment' => 'required|string',
                'rating' => 'required|in:1, 2, 3, 4, 5',
            ]);
            $rating = UserRating::create([
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);
            Ticket::where('id', '=', $ticket->id)->update(['user_rating_id' => $rating->id]);
        };

    }

    public function cities(Request $request)
    {
        return response()->json([
            City::all(),
        ], 200);
    }

    public function neighborhoods(Request $request)
    {
        return response()->json([
            Neighborhood::all(),
        ], 200);
    }
}
