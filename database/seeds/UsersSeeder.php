<?php

use Illuminate\Database\Seeder;
use App\Http\Models\User; 


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Http\Models\User',170)->create();
    }
}
