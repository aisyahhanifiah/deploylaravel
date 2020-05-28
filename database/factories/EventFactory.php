<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
	$randlevel = App\Level::pluck('id')->all();
	$level = $faker->randomElement($randlevel);
	$randcategory = App\Category::pluck('id')->all();
	$category = $faker->randomElement($randcategory);
	$randdomain = App\Domain::pluck('id')->all();
	$domain = $faker->randomElement($randdomain);
	$randclub = App\Club::pluck('id')->all();
	$club = $faker->randomElement($randclub);

    $start = $faker->dateTimeBetween($startDate = 'now', $endDate = '+30 days');
    return [
    	'name' => $faker->company,
    	'description' => $faker->sentence($nbWords = 50, $variableNbWords = true),
    	'venue' => $faker->city,
    	'start_date' => $start,
    	'end_date' => $faker->dateTimeInInterval($start, '+2 days'),
    	'level_id' => $level,
    	'category_id' => $category,
    	'domain_id' => $domain,
    	'club_id' => $club,
    	'requirement' => 'Open to all',
    	'capacity' => $faker->numberBetween($min = 50, $max = 300),
    	'fees' => $faker->numberBetween($min = 0, $max = 15),
    	'created_at' => now(),
    	'updated_at' => now()
    ];
});
