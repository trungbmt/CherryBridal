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
        DB::table('users')->insert([
        	[
	            'username' => 'phamductrungbmt',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => Hash::make('123123'),
	            'role' => 'MEMBER',
        	],
        	[
	            'username' => 'trungbmt',
	            'email' => Str::random(10).'@gmail.com',
	            'password' => Hash::make('123123'),
	            'role' => 'ADMIN',
        	],
            [
                'username' => 'hadestrb',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123123'),
                'role' => 'ADMIN',
            ],
        ]);
    }
}
