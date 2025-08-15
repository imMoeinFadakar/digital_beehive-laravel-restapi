<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0 ; $i < 10; $i++){
             DB::table('users')->insert(
            [
                'first_name'       => 'Admin',
                'last_name'        => 'User',
                'email'            => "admin{$i}@example.com",
                'phone_number'     => "0912345678{$i}",
                'address'          => 'Tehran, Iran',
                'postal_code'      => 1234567890,
                'image'            => null,
                'password'         => Hash::make('admin1234'),
                'refferal_code'    => strtoupper(Str::random(10)),
                'phone_verified_at'=> now(),
                'status'           => 'active',
                'role'             => 'admin',
                'score'            => 0,
                'email_verified_at'=> now(),
                'created_at'       => now(),
                'updated_at'       => now(),
                'remember_token'   => Str::random(10),
            ]);


        }
        
    }
}
