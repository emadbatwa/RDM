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
            'status' => 'ASSIGNED',
        ]);

        DB::table('statuses')->insert([
            'status' => 'IN_PROGRESS',
        ]);

        DB::table('statuses')->insert([
            'status' => 'SOLVED',
        ]);

        DB::table('statuses')->insert([
            'status' => 'DONE',
        ]);

        DB::table('statuses')->insert([
            'status' => 'CLOSED',
        ]);

        DB::table('statuses')->insert([
            'status' => 'EXCLUDED',
        ]);
    }
}
