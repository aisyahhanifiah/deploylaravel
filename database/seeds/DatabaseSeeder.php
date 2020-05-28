<?php

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
        // $this->call([ClubsTableSeeder::class]);
        // $this->call([EventsTableSeeder::class]);
        // $this->call([UsersTableSeeder::class]);
        // $this->call([DomainsTableSeeder::class]);
        // $this->call([LevelsTableSeeder::class]);
        // $this->call([PayMethodTableSeeder::class]);
        // $this->call([PositionsTableSeeder::class]);
        // $this->call([UserClubSeeder::class]);
        $this->call([UserEventSeeder::class]);
        

      
    }
}
