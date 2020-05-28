<?php

use Faker\Generator as Faker;

use App\UserClub;

$factory->define(App\UserClub::class, function (Faker $faker) {
	$randclub = App\Club::pluck('id')->all(); // returns an array of all ids in the Lessons table
	$randuser = App\User::pluck('id')->all();
	// $randclub = [3, 4, 5, 6, 7, 8, 9, 10, 11];
	// $randuser = [1,2,3,4,5,6,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61];
	$club = $faker->randomElement($randclub);
	$user = $faker->randomElement($randuser);
	while (UserClub::where('user_id', $user)->where('club_id', $club)->exists()) {
		// if (($key = array_search($user, $randuser)) !== false) {
		// 	unset($randuser[$key]);
		// }

		// if (($key = array_search($club, $randclub)) !== false) {
		// 	unset($randclub[$key]);
		// }
		$club = $faker->randomElement($randclub);
		$user = $faker->randomElement($randuser);
		
	}

	return [
		'user_id' => $user,
		'club_id' => $club,
        'position_id' => 6, // secret
        'created_at' => now(),
        'updated_at' => now()
    ];
    // $position = $faker->randomElement([1, 4, 5, 6, 7, 8, 9, 10, 11]);
    // return [
    //     'user_id' => $user,
    //     'club_id' => $club,
    //     'position_id' => 6, // secret
    //     'created_at' => now(),
    //     'updated_at' => now()
    // ];
});
