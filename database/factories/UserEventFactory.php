<?php

use Faker\Generator as Faker;

$factory->define(App\UserEvent::class, function (Faker $faker) {
    $randevent = App\Event::pluck('id')->all(); // returns an array of all ids in the Lessons table
	$randuser = App\User::pluck('id')->all();

	$event = $faker->randomElement($randevent);
	$user = $faker->randomElement($randuser);
	

	return [
		'user_id' => $user,
		'event_id' => $event,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
