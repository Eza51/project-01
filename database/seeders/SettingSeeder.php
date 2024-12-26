<?php

namespace Database\Seeders;

use App\Models\Setting;//insert model
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 1php srtisan make:seeder SEttingSeeder(setting hosse database name tarpor sseeder)
     * 2.php artisan db:seed
     */
    public function run(): void//void mane ai function kisu retrurn korbe na..ermohhde je kaj bolsi tai korbe
    {
        //setting array te data nilam
        $settings = [
            // // Define an array of settings to seed into the database
            [
                'setting_name' => 'SETTING_SITE_TITLE',
                'value' => 'Website Title',
            ],
            [
                'setting_name' => 'SETTING_SITE_DESCRIPTION',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_SITE_COPYRIGHT',
                'value' => '&copy; website.com',
            ],
            [
                'setting_name' => 'SETTING_SITE_TIMEZONE',
                'value' => 'Asia/Dhaka',
            ],
            [
                'setting_name' => 'SETTING_SITE_CURRENCY',
                'value' => 'USD',
            ],
            [
                'setting_name' => 'SETTING_SITE_PRELOADING',
                'value' => 'YES',
            ],
            [
                'setting_name' => 'SETTING_SITE_DATE_FORMAT',
                'value' => 'DD-MM-YYYY',
            ],
            [
                'setting_name' => 'SETTING_SITE_TIME_FORMAT',
                'value' => 'HH:MM:SS:tt',
            ],
            [
                'setting_name' => 'SETTING_GOOGLE_ANALYTICS_CODE',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_SITE_LOGO',
                'value' => 'logo.png',
            ],
            [
                'setting_name' => 'SETTING_SITE_FAVICON',
                'value' => 'favicon.png',
            ],
            [
                'setting_name' => 'SETTING_GOOGLE_ADS_CODE',
                'value' => '',
            ],

            [
                'setting_name' => 'SETTING_SOCIAL_FACEBOOK',
                'value' => '#',
            ],
            [
                'setting_name' => 'SETTING_SOCIAL_YOUTUBE',
                'value' => '#',
            ],
            [
                'setting_name' => 'SETTING_SOCIAL_INSTAGRAM',
                'value' => '#',
            ],
            [
                'setting_name' => 'SETTING_SOCIAL_LINKEDIN',
                'value' => '#',
            ],
            [
                'setting_name' => 'SETTING_SOCIAL_TWITTER',
                'value' => '#',
            ],
            [
                'setting_name' => 'SETTING_EMAIL_CONFIG_EMAIL_ADDRESS',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_CONTACT_PAGE_PHONE',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_CONTACT_PAGE_EMAIL',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_CONTACT_PAGE_ADDRESS',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_ABOUT_US_PAGE_TITLE',
                'value' => '',
            ],
            [
                'setting_name' => 'SETTING_ABOUT_US_PAGE_DETAIL',
                'value' => '',
            ],
        ];
// Loop chalaye insert
        foreach ($settings as $setting) {
            // This condition skips creating settings if the setting_name is not 'SETTING_ABOUT_US_DETAIL'
            // which means no settings will be created as none match this condition
            // if ($setting['setting_name'] !== 'SETTING_ABOUT_US_DETAIL') {
            //     continue;
            // }
 // Create a new setting record in the database
            Setting::query()->create($setting);
        }
    }
}
