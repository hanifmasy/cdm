<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Amir Makmur',
                'email'              => 'amir.makmur32@gmail.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-08-25 23:51:37',
                'verification_token' => '',
                'username'           => 'deRazx',
            ],
        ];

        User::insert($users);
    }
}
