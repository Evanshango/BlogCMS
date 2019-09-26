<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'admin' => 1,

            'password' => Hash::make('123456')
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'storage/profiles/account.png',
            'about' => 'Something about me',
            'facebook' => 'https://facebook.com',
            'youtube' => 'https://youtube.com'
        ]);
    }
}
