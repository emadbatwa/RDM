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
        $records = 200;
        factory(App\Photo::class, $records)->create();
        $tickets = \App\Ticket::all();
        foreach ($tickets as $ticket) {
            \App\Photo::create([
                'photo_name' => '5e411f70ef5831581326192.jpeg',
                'ticket_id' => $ticket->id,
                'role_id' => 3,
            ]);

            $users = \App\User::all();
            foreach ($users as $user) {
                if ($user->role_id == 4) {
                    $company = \App\User::where('role_id', '=', 3)->get()->random(1);
                    $user->update(['company' => $company[0]->id]);
                };
            };
        }
    }
}
