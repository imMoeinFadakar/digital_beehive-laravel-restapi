<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Modules\User\Models\User;
use Illuminate\Database\Seeder;
use Modules\TelephoneSeller\Database\Seeders\TelephoneSellerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

       TelephoneSellerSeeder::class;




    }
}
