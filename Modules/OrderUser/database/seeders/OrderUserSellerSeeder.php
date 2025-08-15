<?php

namespace Modules\OrderUser\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderUserSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table("telephone_sellers")->insert([
            "first_name" => "moein",
            "last_name" => "fadakar",
            "married_status" => "single",
            "image" => "image",
            "personel_code" => "a100",
            "password" => Hash::make("moeinfadakar")

        ]);
    }
}
