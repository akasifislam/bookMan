<?php

use App\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Muhammad Asif Ul Islam',
            'email' => 'asif@mail.com',
            'password' => Hash::make('secret007'),
        ]);
    }
}
