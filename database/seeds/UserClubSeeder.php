<?php

use Illuminate\Database\Seeder;
use App\UserClub;

class UserClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 170;
        factory(UserClub::class, $count)->create();
    }
}
