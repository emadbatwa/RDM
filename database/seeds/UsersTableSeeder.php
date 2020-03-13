<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@hotmail.com',
            'password' => bcrypt('password'),
            'name' => 'BOSS',
            'phone' => '0500000000',
            'role_id' => 2,
        ]);
        User::create([
            'email' => 'company@hotmail.com',
            'password' => bcrypt('password'),
            'name' => 'company',
            'phone' => '0511111111',
            'role_id' => 3,
        ]);
        User::create([
            'email' => 'employee1@hotmail.com',
            'password' => bcrypt('password'),
            'name' => 'employee1',
            'phone' => '0544444444',
            'company' => 2,
            'role_id' => 4,
        ]);
        User::create([
            'email' => 'employee2@hotmail.com',
            'password' => bcrypt('password'),
            'name' => 'employee2',
            'phone' => '0588888888',
            'company' => 2,
            'role_id' => 4,
        ]);
        $records = 20;
        factory(App\User::class, $records)->create();

        $users = \App\User::all();
        foreach ($users as $user) {
            if ($user->role_id == 1) {
                $rand = rand(1,2);
                $user->update(['city_id' => 6, 'neighborhood_id' => rand(3377, 3437), 'gender' =>$rand == 1? 'MALE': 'FEMALE']);
            }
        }
    }
}
