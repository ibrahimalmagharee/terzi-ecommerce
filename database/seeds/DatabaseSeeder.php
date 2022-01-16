<?php

use App\Models\Color;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SocialMediaLink;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminDatabaseSeeder::class);
         $this->call(CategoryDatabaseSeeder::class);
         $this->call(VendorDatabaseSeeder::class);
         $this->call(ColorDatabaseSeeder::class);
         $this->call(RoleDatabaseSeeder::class);
         $this->call(PermissionDatabaseSeeder::class);
         $this->call(SocialMediaLinkDatabaseSeeder::class);

//        $links = [
//            [
//                'link' => 'https://facebook.com',
//            ],
//            [
//                'link' => 'https://www.instagram.com',
//            ],
//            [
//                'link' => 'https://twitter.com/',
//            ],
//
//        ];
//
//        foreach ($links as $link) {
//            SocialMediaLink::create($link);
//        }

//       $vendors = [
//          [
//              'name' => 'ابراهيم',
//              'location' => 'غزة',
//              'commercial_registration_No' => '123755',
//              'mobile_No' => '0591478223',
//              'national_Id' => '12345556',
//              'email' => 'ibrahim@gmail.com',
//              'type_activity' => 'تفصيل',
//              'password' => bcrypt('12345'),
//              'service_id' => null,
//          ],
//          [
//              'name' => 'محمد',
//              'location' => 'الرياض',
//              'commercial_registration_No' => '654454654',
//              'mobile_No' => '0594754214',
//              'national_Id' => '424275',
//              'email' => 'mohammed@gmail.com',
//              'type_activity' => 'أقمشة',
//              'password' => bcrypt('12345'),
//              'service_id' => null,
//          ],
//          [
//              'name' => 'علي',
//              'location' => 'القاهرة',
//              'commercial_registration_No' => '455575675',
//              'mobile_No' => '0596416856',
//              'national_Id' => '525274',
//              'email' => 'ali@gmail.com',
//              'type_activity' => 'الاثنين معا',
//              'password' => bcrypt('12345'),
//              'service_id' => null,
//          ],
//      ];
//
//      foreach ($vendors as $vendor) {
//          $ven =Vendor::create($vendor);
//          $image = Image::create([
//              'photo' => 'user-profile.png'
//          ]);
//          $ven->image()->save($image);
//      }
//
//       $colors = [
//           [
//               'color' => 'الاصفر',
//           ],
//           [
//               'color' => 'الاحمر',
//           ],
//           [
//               'color' => 'الاخضر',
//           ],
//           [
//               'color' => 'الازرق',
//           ],
//           [
//               'color' => 'التركوازي',
//           ],
//           [
//               'color' => 'النيلي',
//           ],
//           [
//               'color' => 'البنفسجي',
//           ],
//       ];
//
//      foreach ($colors as $color) {
//      Color::create($color);
//      }
//
//      $role = new Role();
//       $role->name = 'آدمن';
//       $role->save();
//
//       $permissions = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
//
//       $role->permissions()->attach($permissions);
//       $permissions = [
//           [
//               'name' => 'التحكم بالمبيعات',
//               'key' => 'purchase',
//           ],
//           [
//               'name' => 'التحكم بالتجار',
//               'key' => 'vendor',
//           ],
//           [
//               'name' => 'التحكم بمستخدمين لوحة التحكم',
//               'key' => 'users',
//           ],
//           [
//               'name' => 'التحكم بالصلاحيات',
//               'key' => 'roles',
//           ],
//           [
//               'name' => 'التحكم بنبذة الموقع',
//               'key' => 'about-us',
//           ],
//           [
//               'name' => 'التحكم بالعملاء',
//               'key' => 'customer',
//           ],
//           [
//               'name' => 'التحكم بالأقسام',
//               'key' => 'category',
//           ],
//           [
//               'name' => 'التحكم بالأصناف',
//               'key' => 'type',
//           ],
//           [
//               'name' => 'التحكم بالألوان',
//               'key' => 'color',
//           ],
//           [
//               'name' => 'التحكم بأكواد الخصم',
//               'key' => 'coupon',
//           ],
//           [
//               'name' => 'التحكم بالمنتجات ',
//               'key' => 'product',
//           ],
//           [
//               'name' => 'التحكم بمنتجات التصميم',
//               'key' => 'design',
//           ],
//           [
//               'name' => 'التحكم بمنتجات الأقمش',
//               'key' => 'fabric',
//           ],
//
//       ];
//
//       foreach ($permissions as $permission) {
//           Permission::create($permission);
//       }


    }
}
