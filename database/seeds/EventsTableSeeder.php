<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
Use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;
        factory(Event::class, $count)->create();
        // DB::table('events')->insert([
        //     'name' => 'Bootstrap Workshop',
        //     'description' => 'Bootstrap is the most popular HTML,CSS and JS Framework for developing responsive, mobile first projects on the web. The Bootstrap framework is feature rich and offers several benefits to those using it.',
        //     'venue' => 'Level 18, UniKL MIIT',
        //     'start_date' => Carbon::parse('2019-10-23 10:00:00'),
        //     'end_date' => Carbon::parse('2019-10-23 12:00:00'),
        //     'level_id' => 1,
        //     'category_id' => 5,
        //     'domain_id' => 4,
        //     'club_id' => 3,
        //     'requirement' => 'Open to all',
        //     'capacity' => 60,
        //     'fees' => 5.00,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
}
