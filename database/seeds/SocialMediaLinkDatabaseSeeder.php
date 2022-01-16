<?php

use App\Models\SocialMediaLink;
use Illuminate\Database\Seeder;

class SocialMediaLinkDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'link' => 'https://facebook.com',
            ],
            [
                'link' => 'https://www.instagram.com',
            ],
            [
                'link' => 'https://twitter.com/',
            ],

            [
                'link' => 'https://youtube.com/',
            ],

            [
                'link' => 'https://whatsapp.com/',
            ],

            [
                'link' => 'https://snapchat.com/',
            ],

            [
                'link' => 'https://tiktok.com/',
            ],

        ];

        foreach ($links as $link) {
            SocialMediaLink::create($link);
        }
    }
}
