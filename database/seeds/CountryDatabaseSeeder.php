<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name' => 'السعودية',1
            ],
            [
                'name' => 'الكويت',2
            ],
            [
                'name' => 'مصر',3
            ],
            [
                'name' => "المغرب",4
            ],
            [
                'name' => 'قطر',5
            ],
            [
                'name' => 'الإمارات العربية المتحدة',6
            ],
            [
                'name' => 'الجزائر',7
            ],
            [
                'name' => "البحرين",8
            ],
            [
                'name' => 'العراق',9
            ],
            [
                'name' => 'فلسطين',10
            ],
            [
                'name' => 'الأردن',11
            ],
            [
                'name' => "لبنان",12
            ],
            [
                'name' => 'ليبيا',13
            ],
            [
                'name' => 'سلطنة عمان',14
            ],
            [
                'name' => 'سوريا',15
            ],
            [
                'name' => "تونس",16
            ],
            [
                'name' => "اليمن",17
            ]
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
