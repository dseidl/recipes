<?php

use App\User;
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
        factory(User::class)->create([
            'name' => 'David',
            'email' => 'david@imagine-digital.at',
        ]);
        factory(User::class)->create([
            'name' => 'Babsi',
            'email' => 'barbara@imagine-digital.at',
        ]);
//        $this->call(UsersTableSeeder::class);
    }
}
