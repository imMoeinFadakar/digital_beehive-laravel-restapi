<?php

namespace Modules\TelephoneSeller\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\TelephoneSeller\Models\TelephoneSeller;

class TelephoneSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TelephoneSeller::create([
            "first_name" => "moein",
            "last_name" => "hassan",
            "image" => "image",
            "emergency_phone" => "09394082449",
            "personel_code" => 123456,
            "password" => Hash::make("fadakar"),
        ]);
    }
}
