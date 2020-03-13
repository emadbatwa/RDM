<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ClassificationsSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(NeighborhoodsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TicketsSeeder::class);
        Model::reguard();
    }
}
