<?php

use App\Models\Image;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendors = [
            [
                'name' => 'ابراهيم',
                'location' => 'غزة',
                'commercial_registration_No' => '123755',
                'mobile_No' => '0591478223',
                'national_Id' => '12345556',
                'email' => 'ibrahim@gmail.com',
                'type_activity' => 'تفصيل',
                'password' => bcrypt('12345'),
                'service_id' => null,
            ],
            [
                'name' => 'محمد',
                'location' => 'الرياض',
                'commercial_registration_No' => '654454654',
                'mobile_No' => '0594754214',
                'national_Id' => '424275',
                'email' => 'mohammed@gmail.com',
                'type_activity' => 'أقمشة',
                'password' => bcrypt('12345'),
                'service_id' => null,
            ],
            [
                'name' => 'علي',
                'location' => 'القاهرة',
                'commercial_registration_No' => '455575675',
                'mobile_No' => '0596416856',
                'national_Id' => '525274',
                'email' => 'ali@gmail.com',
                'type_activity' => 'الاثنين معا',
                'password' => bcrypt('12345'),
                'service_id' => null,
            ],
        ];

        foreach ($vendors as $vendor) {
            $ven =Vendor::create($vendor);
            $image = Image::create([
                'photo' => 'user-profile.png'
            ]);
            $ven->image()->save($image);
        }
    }
}
