<?php

namespace App\Http\Controllers;

use App\City;
use App\Classification;
use App\Neighborhood;
use App\Photo;
use App\Status;
use App\Ticket;
use App\TicketHistory;
use App\User;
use App\UserRating;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Location;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class TicketController extends Controller
{
    public function list(Request $request)
    {
        $request->validate([
            'status' => 'in:1,2,3,4,5,6,7',
            'neighborhood' => 'numeric| between:3377,3437',
            'classification' => 'in:1, 2, 3, 4, 5, 6, 7, 8, 9, 10',
            'degree' => 'in:1, 2, 3',
        ]);
        $user = $request->user();
        $tickets = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
            ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
            ->join('users', 'users.id', '=', 'tickets.user_id')
            ->leftJoin('damage_degrees', 'damage_degrees.id', '=', 'tickets.damage_degree_id')
            ->select('tickets.id', 'tickets.description', 'tickets.location_id', 'users.name as userName', 'users.phone as userPhone', 'tickets.user_rating_id', 'statuses.status', 'statuses.status_ar', 'tickets.damage_degree_id', 'damage_degrees.degree', 'damage_degrees.degree_ar', 'classifications.id as classification_id', 'classifications.classification', 'classifications.classification_ar', 'tickets.assigned_employee', 'tickets.assigned_company', 'tickets.created_at', 'tickets.updated_at');

        //admin list
        if ($user->role_id == 2) {
            $tickets = $tickets->orderBy('id');
        }
        //company list
        if ($user->role_id == 3) {
            $tickets = $tickets->where('tickets.assigned_company', '=', $user->id)
                ->orderBy('id');

        }

        if ($status = $request->status) {
            $status = strtoupper($status);
            $tickets = $tickets->where('status_id', '=', $status);
        }
        if ($classification = $request->classification) {
            $tickets = $tickets->where('classification_id', '=', $classification);
        }
        if ($degree = $request->degree) {
            $tickets = $tickets->where('damage_degree_id', '=', $degree);
        }
        $tickets = $tickets->get();
        $finalList = array();
        $i = 0;
        $neighborhood = $request->neighborhood;
        foreach ($tickets as $ticket) {
            $location = Location::join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('locations.id', 'locations.neighborhood_id', 'locations.latitude', 'locations.longitude', 'cities.name_ar as city', 'neighborhoods.name_ar as neighborhood')
                ->where('locations.id', '=', $ticket->location_id)->first();

            $photos = Photo::where('ticket_id', '=', $ticket->id)->get();

            $ticketHistories = TicketHistory::where('ticket_id', '=', $ticket->id)->get();

            $userRating = UserRating::where('id', '=', $ticket->user_rating_id)->first();

            $assignedEmployee = User::where('id', '=', $ticket->assigned_employee)->first();
            $assignedEmployee = collect($assignedEmployee)->except(['city_id', 'neighborhood_id', 'gender', 'created_at', 'updated_at', 'active', 'company', 'role_id']);

            $assignedCompany = User::where('id', '=', $ticket->assigned_company)->first();
            $assignedCompany = collect($assignedCompany)->except(['city_id', 'neighborhood_id', 'gender', 'created_at', 'updated_at', 'active', 'company', 'role_id']);

            if ($neighborhood == $location->neighborhood_id || $neighborhood == null) {
                $finalList[$i++] = [
                    'ticket' => $ticket,
                    'location' => $location,
                    'photos' => $photos,
                    'ticketHistories' => $ticketHistories,
                    'userRating' => $userRating,
                    'assignedEmployee' => $assignedEmployee,
                    'assignedCompany' => $assignedCompany,
                ];
            }

        }
        /*$finalList = $this->paginate($finalList);
        $finalList->withPath('/ticket/list');*/
        if (\Auth::user()->role_id == 2) {
            $statistics['open'] = Ticket::where('status_id', '=', 1)->count();
            $statistics['closed'] = Ticket::where('status_id', '=', 6)->count();
            $statistics['total'] = Ticket::count();
            return view('admin.list')->with(['tickets' => $finalList, 'statistics' => $statistics]);
        } elseif (\Auth::user()->role_id == 3) {
            return view('company.list')->with(['tickets' => $finalList]);
        }
        // $finalList = datatables($finalList)->toJson();
    }

    public function map(Request $request)
    {
        $user = $request->user();
        //admin
        if ($user->role_id == 2) {
            $tickets = Ticket::orderBy('id')
                ->get();
        }

        $finalList = array();
        $i = 0;
        foreach ($tickets as $ticket) {
            $location = Location::join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('locations.id', 'locations.latitude', 'locations.longitude', 'cities.name_ar as city', 'neighborhoods.name_ar as neighborhood')
                ->where('locations.id', '=', $ticket->location_id)->first();
            $finalList[$i++] = [
                'ticket' => $ticket,
                'location' => $location,
            ];
        }
        return view('admin.map')->with(['tickets' => $finalList]);
        // $finalList = datatables($finalList)->toJson();
    }

    public function publicMap(Request $request)
    {
        $request->validate([
            'status' => 'in:OPEN,CLOSED,open,closed',
        ]);

        $tickets = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
            ->join('users', 'users.id', '=', 'tickets.user_id')
            ->select('tickets.id', 'tickets.description', 'tickets.location_id', 'statuses.status', 'statuses.status_ar', 'tickets.created_at', 'tickets.updated_at')
            ->orderBy('id');

        if ($status = $request->status) {
            $status = strtoupper($status);
            $tickets = $tickets->where('status', '=', $status);
        }
        $tickets = $tickets->get();
        $finalList = array();
        $i = 0;
        foreach ($tickets as $ticket) {
            $location = Location::select(['locations.latitude', 'locations.longitude'])
                ->where('locations.id', '=', $ticket->location_id)->first();

            $photos = Photo::where('ticket_id', '=', $ticket->id)->get();
            $finalList[$i++] = [
                'ticket' => $ticket,
                'location' => $location,
                'photos' => $photos,
            ];
        }
        return view('publicMap')->with(['tickets' => $finalList]);
        // $finalList = datatables($finalList)->toJson();
    }

    public function showPublic(Request $request)
    {
        $request->validate([
            'ticket_id' => 'numeric',
        ]);

        $wantedTicket = Ticket::findOrFail($request->ticket_id);

        $ticket = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
            ->where('tickets.id', '=', $wantedTicket->id)
            ->select('tickets.id', 'tickets.description', 'tickets.location_id', 'statuses.status', 'statuses.status_ar', 'tickets.created_at', 'tickets.updated_at')
            ->first();

        $location = Location::select(['locations.latitude', 'locations.longitude'])
            ->where('locations.id', '=', $wantedTicket->location_id)->first();

        $photos = Photo::where('ticket_id', '=', $wantedTicket->id)->get();

        $ticket = ['ticket' => $ticket,
            'location' => $location,
            'photos' => $photos,
        ];
        return view('publicShow')->with(['ticket' => $ticket]);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
        $request->validate([
            'ticket_id' => 'numeric',
        ]);

        $user = $request->user();
        $wantedTicket = Ticket::find(Input::get('ticketId'));

        if ($wantedTicket != null && ($wantedTicket->user_id == $user->id || $wantedTicket->assigned_company == $user->id || $wantedTicket->assigned_employee == $user->id || $user->role_id == 2)) {
            $ticket = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
                ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
                ->leftJoin('damage_degrees', 'damage_degrees.id', '=', 'tickets.damage_degree_id')
                ->where('tickets.id', '=', $wantedTicket->id)
                ->select('tickets.id', 'tickets.description', 'tickets.location_id', 'tickets.user_rating_id', 'statuses.status', 'statuses.status_ar', 'damage_degrees.degree', 'damage_degrees.degree_ar', 'classifications.classification', 'classifications.classification_ar', 'tickets.assigned_employee', 'tickets.assigned_company', 'tickets.created_at', 'tickets.updated_at')
                ->first();

            $location = Location::join('cities', 'cities.id', '=', 'locations.city_id')
                ->join('neighborhoods', 'neighborhoods.id', '=', 'locations.neighborhood_id')
                ->select('locations.id', 'locations.latitude', 'locations.longitude', 'cities.name_ar as city', 'neighborhoods.name_ar as neighborhood')
                ->where('locations.id', '=', $wantedTicket->location_id)->first();

            $photos = Photo::where('ticket_id', '=', $wantedTicket->id)->get();

            $ticketHistories = TicketHistory::where('ticket_id', '=', $wantedTicket->id)->get();

            $userRating = UserRating::where('id', '=', $wantedTicket->user_rating_id)->first();

            $assignedEmployee = User::where('id', '=', $wantedTicket->assigned_employee)->first();
            $assignedEmployee = collect($assignedEmployee)->except(['city_id', 'neighborhood_id', 'gender', 'created_at', 'updated_at', 'active', 'company', 'role_id']);

            $assignedCompany = User::where('id', '=', $wantedTicket->assigned_company)->first();
            $assignedCompany = collect($assignedCompany)->except(['city_id', 'neighborhood_id', 'gender', 'created_at', 'updated_at', 'active', 'company', 'role_id']);


            $ticket = ['ticket' => $ticket,
                'location' => $location,
                'photos' => $photos,
                'ticketHistories' => $ticketHistories,
                'userRating' => $userRating,
                'assignedEmployee' => $assignedEmployee,
                'assignedCompany' => $assignedCompany,
            ];
            if (\Auth::user()->role_id == 2) {
                //return view('admin.show')->with(['ticket' => $ticket]);
                return response()->json($this->utf8ize($ticket));
            } elseif (\Auth::user()->role_id == 3) {
                //return view('company.show')->with(['ticket' => $ticket]);
                return response()->json($this->utf8ize($ticket));
            }
        } else {
            return redirect()->back();
        }
    }
    }

    public function update(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required | numeric',
        ]);

        if ($request->user()->role_id == 2 && $request->status == Status::ASSIGNED) {
            $request->validate([
                'company_id' => 'required | numeric',
                'message' => 'string',
                'classification_id' => 'in:1, 2, 3, 4, 5, 6, 7, 8, 9, 10'
            ]);

            $ticket = Ticket::find($request->ticket_id);
            $company = User::find($request->company_id);

            if ($company->role_id == 3 && $ticket->assigned_company == null && $ticket->status->id == 1 || $ticket->status->id == 5) {
                if ($ticket->status->id == 1) {
                    $ticket->update(['assigned_company' => $company->id, 'status_id' => 2]);
                }
                if ($classification_id = $request->classification_id) {
                    $ticket->update(['classification_id' => $classification_id]);
                }
                //need to implement a way to delete the photo from storage or not?
                $photos = Photo::where('ticket_id', '=', $ticket->id)->where('role_id', '=', 3)->get();
                foreach ($photos as $photo) {
                    \Storage::delete('public/photos/' . $photo->photo_name);
                    $photo->delete();
                }
                if ($message = $request->message) {
                    TicketHistory::create([
                        'message' => $message,
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
                'degree_id' => 'required|in:1, 2, 3',
                'photos.*' => 'image|mimes:jpg,jpeg',
            ], $messages);
            $ticket = Ticket::find($request->ticket_id);
            $employee = $request->user();
            $degree = $request->degree_id;

            if ($ticket->assigned_employee == $employee->id && $ticket->assigned_company == $employee->company && $ticket->status->id == 3 && $photos = $request->file('photos')) {
                $ticket->update(['damage_degree_id' => $degree, 'status_id' => 4]);
                $i = 1;

                foreach ($photos as $photo) {
                    $filename = $i++ . time() . '.' . $photo->extension();
                    $photo->move(storage_path('app/public/photos'), $filename);
                    Photo::create([
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
                'message' => 'string',
            ]);

            $ticket = Ticket::find($request->ticket_id);
            $company = $request->user();

            if ($ticket->assigned_company == $company->id && $ticket->status->id == 4) {
                $ticket->update(['status_id' => 5]);
                if ($message = $request->message) {
                    TicketHistory::create([
                        'message' => $message,
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

    /**
     * The attributes that are mass assignable.
     *
     * @return LengthAwarePaginator
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}