<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'name' => 'الرياض',
                'country_id' => 1,
            ],
            [
                'name' => 'جدة',
                'country_id' => 1,
            ],
            [
                'name' => 'مكة المكرمة',
                'country_id' => 1,
            ],
            [
                'name' => "المدينة المنورة",
                'country_id' => 1,
            ],
            [
                'name' => 'الطائف',
                'country_id' => 1,
            ],
            [
                'name' => 'الدمام',
                'country_id' => 1,
            ],
            [
                'name' => ' الأحمدي ',
                'country_id' => 2,
            ],
            [
                'name' => " حولي ",
                'country_id' => 2,
            ],
            [
                'name' => ' السالمية ',
                'country_id' => 2,
            ],
            [
                'name' => ' صباح السالم ',
                'country_id' => 2,
            ],
            [
                'name' => ' الفروانية ',
                'country_id' => 2,
            ],
            [
                'name' => " الفحيحيل ",
                'country_id' => 2,
            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => '',
//                'country_id' => ,
//            ],
//            [
//                'name' => "",
//                'country_id' => ,
//            ],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
