<?php

use Illuminate\Database\Seeder;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->insert([
            'name' => 'Social',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('domains')->insert([
            'name' => 'Career',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('domains')->insert([
            'name' => 'Emotional',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('domains')->insert([
            'name' => 'Intellectual',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('domains')->insert([
            'name' => 'Physical',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('domains')->insert([
            'name' => 'Spiritual',
            'created_at' => now(),
            'updated_at' => now()
        ]);
       
    }
}
