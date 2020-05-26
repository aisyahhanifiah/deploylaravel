<?php

use Illuminate\Database\Seeder;

class PayMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pay_method')->insert([
            'name' => 'Online Banking',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pay_method')->insert([
            'name' => 'Cash',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
