<?php

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'color' => 'الاصفر',
            ],
            [
                'color' => 'الاحمر',
            ],
            [
                'color' => 'الاخضر',
            ],
            [
                'color' => 'الازرق',
            ],
            [
                'color' => 'التركوازي',
            ],
            [
                'color' => 'النيلي',
            ],
            [
                'color' => 'البنفسجي',
            ],
        ];

        foreach ($colors as $color) {
        Color::create($color);
        }
    }
}
