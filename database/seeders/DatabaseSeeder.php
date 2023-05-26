<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            "name" => "kim",
            "email" => "kim@gmail.com",
            "password" => Hash::make("swsxswsx"),
        ]);
        User::create([
            "name" => "myueway98",
            "email" => "myueway98@gmail.com",
            "password" => Hash::make("swsxswsx"),
        ]);
        User::create([
            "name" => "james",
            "email" => "james@gmail.com",
            "password" => Hash::make("swsxswsx"),
        ]);
        Contact::factory(10)->create();
    }
}
