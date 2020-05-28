<?php

use Illuminate\Database\Seeder;

class UserEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        factory(App\UserEvent::class, $count)->create();
    }
}
