<?php

use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = 100;
        factory(App\Ticket::class, $records)->create();
        $badRoads = [
            0 => '11567001134.jpeg',
            1 => '11568001134.jpeg',
            2 => '11584111134.jpeg',
            3 => '11974001134.jpeg',
        ];

        $goodRoads = [
            0 => '11584001145.jpeg',
            1 => '11584087134.jpeg',
            2 => '11584101134.jpeg',
            3 => '14584001134.jpeg',
        ];


        $tickets = \App\Ticket::all();
        foreach ($tickets as $ticket) {

            foreach ($badRoads as $badRoad) {
                \App\Photo::create([
                    'photo_name' => $badRoad,
                    'ticket_id' => $ticket->id,
                    'role_id' => 1,
                ]);
            }
            //assigned to a company
            if ($ticket->status_id == 2) {
                $ticket->assigned_company = 2;
                $ticket->save();
                \App\TicketHistory::create([
                    'sender' => 1,
                    'receiver' => 2,
                    'massage' => 'يجب اصلاح هذه التذكرة بأسرع وقت',
                    'ticket_id' => $ticket->id,
                ]);
            }
            //In progress
            if ($ticket->status_id == 3) {
                $ticket->assigned_company = 2;
                \App\TicketHistory::create([
                    'sender' => 1,
                    'receiver' => 2,
                    'massage' => 'يجب اصلاح هذه التذكرة بأسرع وقت',
                    'ticket_id' => $ticket->id,
                ]);
                $ticket->assigned_employee = rand(3, 4);
                $ticket->save();
            }
            //Solved
            if ($ticket->status_id == 4) {
                $ticket->assigned_company = 2;
                \App\TicketHistory::create([
                    'sender' => 1,
                    'receiver' => 2,
                    'massage' => 'يجب اصلاح هذه التذكرة بأسرع وقت',
                    'ticket_id' => $ticket->id,
                ]);
                $ticket->assigned_employee = rand(3, 4);
                $ticket->save();
                foreach ($goodRoads as $goodRoad) {
                    \App\Photo::create([
                        'photo_name' => $goodRoad,
                        'ticket_id' => $ticket->id,
                        'role_id' => 3,
                    ]);
                }
            }
            //Done
            if ($ticket->status_id == 5) {
                $ticket->assigned_company = 2;
                \App\TicketHistory::create([
                    'sender' => 1,
                    'receiver' => 2,
                    'massage' => 'يجب اصلاح هذه التذكرة بأسرع وقت',
                    'ticket_id' => $ticket->id,
                ]);
                $ticket->assigned_employee = rand(3, 4);
                $ticket->save();
                foreach ($goodRoads as $goodRoad) {
                    \App\Photo::create([
                        'photo_name' => $goodRoad,
                        'ticket_id' => $ticket->id,
                        'role_id' => 3,
                    ]);
                }
                \App\TicketHistory::create([
                    'sender' => 2,
                    'receiver' => 1,
                    'massage' => 'تم اصلاحها في أقل من يوم',
                    'ticket_id' => $ticket->id,
                ]);
            }
            //Closed
            if ($ticket->status_id == 6) {
                $ticket->assigned_company = 2;
                \App\TicketHistory::create([
                    'sender' => 1,
                    'receiver' => 2,
                    'massage' => 'يجب اصلاح هذه التذكرة بأسرع وقت',
                    'ticket_id' => $ticket->id,
                ]);
                $ticket->assigned_employee = rand(3, 4);
                $ticket->save();
                foreach ($goodRoads as $goodRoad) {
                    \App\Photo::create([
                        'photo_name' => $goodRoad,
                        'ticket_id' => $ticket->id,
                        'role_id' => 3,
                    ]);
                }
                \App\TicketHistory::create([
                    'sender' => 2,
                    'receiver' => 1,
                    'massage' => 'تم اصلاحها في أقل من يوم',
                    'ticket_id' => $ticket->id,
                ]);
                if (rand(1,2) == 1) {
                    $userRating = \App\UserRating::create([
                        'rating' => rand(1, 5),
                        'comment' => 'شكرا لكم'
                    ]);
                    $ticket->user_rating_id = $userRating->id;
                    $ticket->save();
                }
            }
        }
    }
}
