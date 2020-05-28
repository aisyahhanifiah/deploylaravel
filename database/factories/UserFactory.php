<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
// 'name' => 'Adam Ghani',
//             'email' => 'adam.ghani@unikl.edu.my',
//             'email_verified_at' => now(),
//             'password' => Hash::make('secret'),
//             'unikl_id' => 52213118123,
//             'phone_no' => '0176576767',
//             'gender' => 'Male',
//             'dob' => Carbon::parse('1998-09-07'),
//             'image' => 'logo.jpg',
//             'created_at' => now(),
//             'updated_at' => now()

$factory->define(App\User::class, function (Faker $faker) {
	$gender = $faker->randomElement(['male', 'female']);
    return [
        'name' => $faker->name($gender),
        'email' => preg_replace('/@example\..*/', '@unikl.edu.my', $faker->unique()->safeEmail),
        'password' => bcrypt('secret'), // secret
        'unikl_id' => $faker->numerify('###########'),
        'phone_no' => $faker->voipNumber(),
        'gender' => $gender,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'image' => NULL,
        'remember_token' => NULL,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
