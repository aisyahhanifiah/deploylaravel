<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => 'President',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('positions')->insert([
            'name' => 'Vice President',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('positions')->insert([
            'name' => 'Secretary',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('positions')->insert([
            'name' => 'Treasurer',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('positions')->insert([
            'name' => 'Advisor',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('positions')->insert([
            'name' => 'Student',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
