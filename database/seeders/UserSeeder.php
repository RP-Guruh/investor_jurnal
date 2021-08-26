<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        \App\Models\User::insert([
            [
                'id_anggota' => '201643500578',
                'name' => 'Guruh Rachmat Pribadi',
                'tanggal_bergabung' => '2021-07-23',
                'nominal_investasi' => '5000000',
                'email' => 'investor1@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // password
                'active' => 1,
                'remember_token' => Str::random(10)
            ]
        ]);

        // Fake users
        //  User::factory()->times(9)->create();
    }
}
