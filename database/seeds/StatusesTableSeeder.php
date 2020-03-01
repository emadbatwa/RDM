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
            'status_ar' => 'مفتوحة',
        ]);

        DB::table('statuses')->insert([
            'status' => 'ASSIGNED',
            'status_ar' => 'مسندة',
        ]);

        DB::table('statuses')->insert([
            'status' => 'IN_PROGRESS',
            'status_ar' => 'قيد الاصلاح',
        ]);

        DB::table('statuses')->insert([
            'status' => 'SOLVED',
            'status_ar' => 'تم الحل',
        ]);

        DB::table('statuses')->insert([
            'status' => 'DONE',
            'status_ar' => 'مقبولة',
        ]);

        DB::table('statuses')->insert([
            'status' => 'CLOSED',
            'status_ar' => 'مغلقة',
        ]);

        DB::table('statuses')->insert([
            'status' => 'EXCLUDED',
            'status_ar' => 'مستبعدة',
        ]);
    }
}
