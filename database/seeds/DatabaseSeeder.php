<?php

use Illuminate\Database\Seeder;
use App\Model\Client as Client;
use App\User as User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class, 10)->create();
        factory(User::class, 10)->create();
    }
}
