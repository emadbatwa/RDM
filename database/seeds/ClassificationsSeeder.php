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
            'classification_ar' => 'غير ذلك',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'CRACKS',
            'classification_ar' => 'تشققات',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'PATCHING',
            'classification_ar' => 'رقع',

        ]);

        DB::table('classifications')->insert([
            'classification' => 'UTILITY_COVER',
            'classification_ar' => 'أغطية خدمات',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'UTILITY_CUT',
            'classification_ar' => 'حفريات',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'RAVELLING_AND_WEATHERING',
            'classification_ar' => 'تجمع مياه',
        ]);
    }
}
