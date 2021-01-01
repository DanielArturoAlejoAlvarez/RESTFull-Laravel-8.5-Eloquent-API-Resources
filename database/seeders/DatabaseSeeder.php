<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name'      =>  'Mark Zuckerberg',
            'email'     =>  'markzuck@yahoo.com',
            'password'  =>  bcrypt('password1')
        ]);

        \App\Models\Post::factory(18)->create();
    }
}
