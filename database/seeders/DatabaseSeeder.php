<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Jorem Belen',
            'username' => 'jorem.belen',
            'email' => 'rcl.support@rezayat.net',
            'role' =>  1,
            'password' => 'password',
        ]);

        Room::create([
            'name' => 'All Purpose Hall - HO',
            'color' => '#FF0000',
        ]);
        Room::create([
            'name' => 'Main Conference Room - HO',
            'color' => '#0000FF',
        ]);
        Room::create([
            'name' => 'Conference Room 1 - Ladies Section',
            'color' => '#000000',
        ]);
        Room::create([
            'name' => 'Conference Room 2 - Accounts Section',
            'color' => '#FF00FF',
        ]);

    }


}
