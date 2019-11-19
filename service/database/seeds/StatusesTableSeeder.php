<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'status' => 'OPEN',
        ]);

        DB::table('statuses')->insert([
            'status' => 'CLOSED',
        ]);

        DB::table('statuses')->insert([
            'status' => 'IN_PROGRESS',
        ]);
    }
}
