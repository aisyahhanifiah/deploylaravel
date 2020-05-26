<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => 'Campus',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('levels')->insert([
            'name' => 'University',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('levels')->insert([
            'name' => 'National',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('levels')->insert([
            'name' => 'International',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
