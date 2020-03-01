<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role' => 'USER',
            'role_ar' => 'مستخدم',
        ]);

        DB::table('roles')->insert([
            'role' => 'ADMIN',
            'role_ar' => 'مدير',
        ]);

        DB::table('roles')->insert([
            'role' => 'COMPANY',
            'role_ar' => 'شركة',
        ]);

        DB::table('roles')->insert([
            'role' => 'EMPLOYEE',
            'role_ar' => 'موظف',
        ]);
    }
}
