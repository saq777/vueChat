<?php

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
        $users = [
            [
                "name"     => "Jhon",
                "email"    => "TestJhon@mail.ru",
                "password" => Hash::make("123123"),
            ],
            [
                "name"     => "Jack",
                "email"    => "TestJack@mail.ru",
                "password" => Hash::make("123123"),
            ]
        ];

        foreach ($users as $user) {
            dump("The config settings you can find in the .env.example file");
            \App\User::create($user);
        }
    }
}
