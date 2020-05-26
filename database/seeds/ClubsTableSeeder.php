<?php

use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clubs')->insert([
            'name' => 'Software Engineering Club',
            'description' => 'The Software Engineering Club is to encourage members who have a passion for software development.',
            'semester' => 'July 2019',
            'domain_id' => 4,
            'requirement' => 'Software Engineering student only',
            'capacity' => 200,
            'fees' => 5.00,
            'url_email' => 'seclub@unikl.edu.my',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('clubs')->insert([
            'name' => 'Kelab Rekreasi UniKL MIIT',
            'description' => 'A recreation club which are one of a medium for MIIT student to express their love to nature and their desire to outdoors activities.',
            'semester' => 'July 2019',
            'domain_id' => 5,
            'requirement' => 'Open to all',
            'capacity' => 220,
            'fees' => 10.00,
            'url_fb' => 'https://web.facebook.com/uniklmiitrecretionalclub/',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
