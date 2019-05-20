<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' 		=> 1,
            'fullname' 	=> 'Nathalia Lima',
            'shortname' => 'Nathalia',
            'password' 	=> Hash::make('secret'),
            'email' 	=> 'nath@email.com',
            'phone' 	=> '81999889988',
            'birthday' 	=> '1995-11-19',
            'role' 		=> User::ADMIN,
        ]);

    }
}
