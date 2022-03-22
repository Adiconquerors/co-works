<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker::create('App\User');
        
        for($i = 1 ; $i <= 10 ; $i++){
        	DB::table('users')->insert([
        	'name' => $faker->name,
        	'password' => bcrypt('secret'),
        	'email' => $faker->safeEmail,
        	'email_verified_at' => \Carbon\Carbon::now(),
        	'created_at' => \Carbon\Carbon::now(),
        	'Updated_at' => \Carbon\Carbon::now(),
        	'remember_token' => str_random(10),
        ]);
        }
    }
}
