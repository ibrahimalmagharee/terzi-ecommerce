<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'التحكم بالمبيعات',
                'key' => 'purchase',
            ],
            [
                'name' => 'التحكم بالتجار',
                'key' => 'vendor',
            ],
            [
                'name' => 'التحكم بمستخدمين لوحة التحكم',
                'key' => 'users',
            ],
            [
                'name' => 'التحكم بالصلاحيات',
                'key' => 'roles',
            ],
            [
                'name' => 'التحكم بنبذة الموقع',
                'key' => 'about-us',
            ],
            [
                'name' => 'التحكم بالعملاء',
                'key' => 'customer',
            ],
            [
                'name' => 'التحكم بالأقسام',
                'key' => 'category',
            ],
            [
                'name' => 'التحكم بالأصناف',
                'key' => 'type',
            ],
            [
                'name' => 'التحكم بالألوان',
                'key' => 'color',
            ],
            [
                'name' => 'التحكم بأكواد الخصم',
                'key' => 'coupon',
            ],
            [
                'name' => 'التحكم بالمنتجات ',
                'key' => 'product',
            ],
            [
                'name' => 'التحكم بمنتجات التصميم',
                'key' => 'design',
            ],
            [
                'name' => 'التحكم بمنتجات الأقمشة',
                'key' => 'fabric',
            ],

            [
                'name' => 'التحكم بالشروط و الأحكام',
                'key' => 'term_condition',
            ],

            [
                'name' => 'التحكم بسياسة الاستخدام',
                'key' => 'usage_policy',
            ],

            [
                'name' => 'التحكم بروابط مواقع التواصل',
                'key' => 'social_media_link',
            ],

            [
                'name' => 'التحكم بالشعار',
                'key' => 'logo',
            ],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
