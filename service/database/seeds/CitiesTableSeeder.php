<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $json = File::get(storage_path('/app/public/json/cities.json'));
        $data = json_decode($json);
        //$array1 = (array) $data->toArray();
        foreach ($data->data as $obj) {
            DB::table('cities')->insert(array(
                'id' => $obj->id,
                'name_ar' => $obj->nameAr,
                'name_en' => $obj->nameEn
            ));
        }
    }
}
