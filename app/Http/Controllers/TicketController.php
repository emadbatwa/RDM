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
use http\Env\Response;
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

            $assignedEmployee = User::where('id', '=', $ticket->assigned_employee)->select('id', 'name', 'phone', 'email')->first();

            $assignedCompany = User::where('id', '=', $ticket->assigned_company)->select('id', 'name', 'phone', 'email')->first();

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
        $tickets = '';
        foreach ($finalList as $ticket) {
            $tickets = $tickets . '<tr class="table-row" id="' . $ticket['ticket']->id . '" data-toggle="modal"
                                            onclick="getid(this);" data-target="#detailsModal">
                                            <td>' . $ticket['ticket']->id . '</td>
                                            <td>' . $ticket['ticket']->description . '</td>
                                            <td>' . $ticket['ticket']->status_ar . '</td>';
            if ($ticket['ticket']->degree_ar != null) {
                $tickets = $tickets . '<td>' . $ticket['ticket']->degree_ar . '</td>';
            } else {
                $tickets = $tickets . '<td>لا يوجد</td>';
            }
            $tickets = $tickets . '<td>' . $ticket['ticket']->classification_ar . '</td>';

            if (\Auth::user()->role_id == 2) {
                 if ($ticket['assignedCompany'] != null) {
                  $tickets = $tickets . '<td>' . $ticket['assignedCompany']->name . '</td>';
                 } else {
                      $tickets = $tickets . '<td>لا يوجد</td>';
                     }
           }elseif (\Auth::user()->role_id == 3){
            if ($ticket['assignedEmployee'] != null) {
                $tickets = $tickets . '<td>' . $ticket['assignedEmployee']->name . '</td>';
               } else {
                    $tickets = $tickets . '<td>لا يوجد</td>';
                   }

           }


            $tickets = $tickets . '<td>' . $ticket['ticket']->created_at . '</td></tr>';
        }
        /*$finalList = $this->paginate($finalList);
        $finalList->withPath('/ticket/list');*/
        if (\Auth::user()->role_id == 2) {
            if ($request->ajax()) {
                return response()->json($tickets);
            }
            $statistics['open'] = Ticket::where('status_id', '=', 1)->count();
            $statistics['closed'] = Ticket::where('status_id', '=', 6)->count();
            $statistics['total'] = Ticket::count();
            // return $finalList;
            $locations = Location::select('latitude', 'longitude')->get();
            return view('admin.list')->with(['tickets' => $tickets, 'statistics' => $statistics, 'locations' => $locations]);
        } elseif (\Auth::user()->role_id == 3) {
            if ($request->ajax()) {
                return response()->json($tickets);
            }
             return view('company.list')->with(['tickets' => $tickets]);
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
            ->whereIn('tickets.status_id', [1, 6])
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
        return view('publicMap.public_map')->with(['tickets' => $finalList]);
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
            $wantedTicket = Ticket::find($request->get('ticketId'));

            if ($wantedTicket != null && ($wantedTicket->user_id == $user->id || $wantedTicket->assigned_company == $user->id || $wantedTicket->assigned_employee == $user->id || $user->role_id == 2)) {
                $ticket = Ticket::join('statuses', 'statuses.id', '=', 'tickets.status_id')
                    ->join('classifications', 'classifications.id', '=', 'tickets.classification_id')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
                    ->leftJoin('damage_degrees', 'damage_degrees.id', '=', 'tickets.damage_degree_id')
                    ->where('tickets.id', '=', $wantedTicket->id)
                    ->select('tickets.id', 'tickets.description', 'tickets.location_id', 'tickets.user_rating_id', 'statuses.status', 'users.name as userName', 'users.phone as userPhone', 'statuses.status_ar', 'damage_degrees.degree', 'damage_degrees.degree_ar', 'classifications.classification', 'classifications.classification_ar', 'tickets.assigned_employee', 'tickets.assigned_company', 'tickets.created_at', 'tickets.updated_at')
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
                    $companies = User::where('role_id', '=', 3)->select('id', 'name', 'phone')->get();
                    $classifications = Classification::select('id', 'classification_ar')->get();
                    return response()->json(['ticket' => $ticket, 'companies' => $companies, 'classifications' => $classifications]);
                } elseif (\Auth::user()->role_id == 3) {
                    $employees = User::where('role_id', '=', 4)->select('id', 'name', 'phone')->get();
                   $classifications = Classification::select('id', 'classification_ar')->get();
                    return response()->json(['ticket' => $ticket, 'employees' => $employees, 'classifications' => $classifications]);
                }
            } else {
                return response()->json('failed');
            }
        }
    }


    public function update(Request $request)
    {
        if ($request->ajax()) {
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
                    return response()->json(['message' => 'تم اسناد التذكرة'], 200);
                } else {
                    return response()->json(['message' => 'لم ينجح الاسناد'], 400);
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
                    } else {
                        $ticket->update(['status_id' => 3]);
                    }
                    //need to implement a way to delete the photo from storage or not?
                    $photos = Photo::where('ticket_id', '=', $ticket->id)->where('role_id', '=', 3)->get();
                    foreach ($photos as $photo) {
                        \Storage::delete('public/photos/' . $photo->photo_name);
                        $photo->delete();
                    }

                    return response()->json(['message' => 'تم اسناد التذكرة الى الموظف'], 200);
                } else {
                    return response()->json(['message' => 'لم ينجح الاسناد'], 400);
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
                    return response()->json(['message' => 'تم رفع الحل للادارة'], 200);
                } else {
                    return response()->json(['message' => 'لم ينجح رفع الحل'], 400);
                }
            }

            if ($request->user()->role_id == 2 && $request->status == Status::CLOSED) {

                $ticket = Ticket::find($request->ticket_id);

                if ($ticket->status->id == 5) {
                    $ticket->update(['status_id' => 6]);

                    return response()->json(['message' => 'تم اغلاق التذكرة'], 200);
                } else {
                    return response()->json(['message' => 'لم يتم اغلاق التذكرة'], 400);
                }
            }

            if ($request->user()->role_id == 2 && $request->status == Status::EXCLUDED) {

                $ticket = Ticket::find($request->ticket_id);

                if ($ticket->status->id == 1) {
                    $ticket->update(['status_id' => 7]);

                    return response()->json(['message' => 'تم استبعاد التذكرة'], 200);
                } else {
                    return response()->json(['message' => 'لم يتم استبعاد التذكرة'], 400);
                }
            }
            return response()->json(['message' => 'حصلت مشكلة'], 400);
        }
    }

    public function updateClassification(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'ticket_id' => 'required | numeric | exists:tickets,id',
                'classification' => 'required | numeric | exists:classifications,id'
            ]);
            $ticket = Ticket::find($request->ticket_id);

            if (\Auth::user()->role_id == 2 && $ticket->status_id == 1) {
                $classification = $request->get('classification');
                $ticket->update(['classification_id'=> $classification]);
                return response()->json(['message' => 'تم تحديث تصنيف التذكرة'], 200);
            } else {
                return response()->json(['message' => 'يوجد خطأ في الارسال'], 400);
            }
        }
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
