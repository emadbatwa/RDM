<?php

use Illuminate\Database\Seeder;

class ClassificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classifications')->insert([
            'classification' => 'OTHER',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'CRACKS',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'PATCHING',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'UTILITY_COVER',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'UTILITY_CUT',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'RAVELLING_AND_WEATHERING',
        ]);
    }
}
