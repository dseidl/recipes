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
            'name' => 'David Seidl',
            'email' => 'admin@example.com',
        ]);
//        $this->call(UsersTableSeeder::class);
    }
}
