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
        $records = 20;
        factory(App\User::class, $records)->create();
    }
}
