<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 50;
        factory(User::class, $count)->create();
        // DB::table('users')->insert([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@clubhub.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 521999,
        //     'phone_no' => '0198821432',
        //     'gender' => 'Female',
        //     'dob' => Carbon::parse('1996-04-16'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Aisyah Hanifiah',
        //     'email' => 'naisyah.hanifiah@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 52213117339,
        //     'phone_no' => '0197799074',
        //     'gender' => 'Female',
        //     'dob' => Carbon::parse('1996-04-16'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Nur Awadah Ismail',
        //     'email' => 'nawadah.ismail@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 52213117102,
        //     'phone_no' => '0126782356',
        //     'gender' => 'Female',
        //     'dob' => Carbon::parse('1996-06-30'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Amira Rashid',
        //     'email' => 'amira.rashid@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 52213117054,
        //     'phone_no' => '0157882904',
        //     'gender' => 'Female',
        //     'dob' => Carbon::parse('1996-01-23'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Mohd Hisham Mikhail',
        //     'email' => 'mhisham.mikhail@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 522455,
        //     'phone_no' => '0143221463',
        //     'gender' => 'Male',
        //     'dob' => Carbon::parse('1970-11-11'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Fadhilah Tariq',
        //     'email' => 'fadhilah.tariq@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 522656,
        //     'phone_no' => '0175654277',
        //     'gender' => 'Female',
        //     'dob' => Carbon::parse('1984-04-01'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Adam Ghani',
        //     'email' => 'adam.ghani@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 52213118123,
        //     'phone_no' => '0176576767',
        //     'gender' => 'Male',
        //     'dob' => Carbon::parse('1998-09-07'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Fakhrul Mohd Hanif',
        //     'email' => 'fakhrul.hanif@unikl.edu.my',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'unikl_id' => 52213118077,
        //     'phone_no' => '0186767888',
        //     'gender' => 'Male',
        //     'dob' => Carbon::parse('1997-09-13'),
        //     'image' => 'logo.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }
}
