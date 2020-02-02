<?php

use Illuminate\Database\Seeder;

class NeighborhoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $json = File::get(storage_path('/app/public/json/Neighborhoods.json'));
        $data = json_decode($json);
        //$array1 = (array) $data->toArray();
        foreach ($data->data as $obj) {
            DB::table('neighborhoods')->insert(array(
                'id' => $obj->id,
                'name_ar' => $obj->nameAr,
                'name_en' => $obj->nameEn,
                'city_id' => $obj->cityId
            ));
        }
    }
}
