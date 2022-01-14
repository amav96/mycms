<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Http\Models\User; 
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'role' =>  'user',
        'status' => 'activo',
        'identification' =>  User::all()->random()->id,
        'firstName' => $faker->name,
        'lastName' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
        'token_validate' => Str::random(10),
        'created_at' => now()

    ];
});

// execute
// php artisan db:seed --class=UsersSeeder

