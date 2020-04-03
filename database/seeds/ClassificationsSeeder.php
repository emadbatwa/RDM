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
        # 0 - Wheel mark part (Linear crack - Longitudinal)
# 1 - Construction joint part (Linear crack - Longitudinal)
# 2 - Equal interval (Linear crack - Lateral)
# 3 - Construction joint part (Linear crack - Lateral)
# 4 - Partial pavement (Alligator crack)
# 5 - Rutting, bump, pothole, separation
# 6 - White line blur
# 7 - Cross walk blur
# 8 - Weathering
        DB::table('classifications')->insert([
            'classification' => 'Wheel mark part (Linear crack - Longitudinal)',
            'classification_ar' => 'شقوق طولية 1',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Construction joint part (Linear crack - Longitudinal)',
            'classification_ar' => 'شقوق طولية 2',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Equal interval (Linear crack - Lateral)',
            'classification_ar' => 'شقوق عرضية 1',

        ]);

        DB::table('classifications')->insert([
            'classification' => 'Construction joint part (Linear crack - Lateral)',
            'classification_ar' => 'شقوق عرضية 2',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Partial pavement (Alligator crack)',
            'classification_ar' => 'شقوق شبكية / تمساحية',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Rutting, bump, pothole, separation',
            'classification_ar' => 'حفر، أخدود، نتوء، انفصال',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'White line blur',
            'classification_ar' => 'طمس خط المسار',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Cross walk blur',
            'classification_ar' => 'طمس معبر المشاه',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Weathering',
            'classification_ar' => 'تآكل',
        ]);

        DB::table('classifications')->insert([
            'classification' => 'Other',
            'classification_ar' => 'غير ذلك',
        ]);
    }
}
