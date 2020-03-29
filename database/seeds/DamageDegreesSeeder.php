<?php

use Illuminate\Database\Seeder;

class DamageDegreesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('damage_degrees')->insert([
            'degree' => 'SEVERE',
            'degree_ar' => 'شديد',
        ]);
        DB::table('damage_degrees')->insert([
            'degree' => 'MODERATE',
            'degree_ar' => 'متوسط',
        ]);
        DB::table('damage_degrees')->insert([
            'degree' => 'SIMPLE',
            'degree_ar' => 'بسيط',
        ]);
    }
}
