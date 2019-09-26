<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'site_name' => 'BlogCMS',
            'address' => 'Nairobi, Kenya',
            'contact_number' => '+254 712 345 678',
            'contact_email' => 'info@blogcms.com',
        ]);
    }
}
