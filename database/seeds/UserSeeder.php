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
        $users = [
            ['id' => 1, 'fullname' => 'ADMIN', 'shortname' => 'ADMIN', 'password' => Hash::make('admin'), 'email' => 'admin@email.com', 'phone' => '81900000000', 'birthday' => '2019-05-21', 'role' => User::ADMIN ],
            ['id' => 2, 'fullname' => 'Entregador 1', 'shortname' => 'Entregador 1', 'password' => Hash::make('entregador'), 'email' => 'entregador1@email.com', 'phone' => '81900000000', 'birthday' => '2019-05-21', 'role' => User::DELIVERYMAN ],
            ['id' => 3, 'fullname' => 'Entregador 2', 'shortname' => 'Entregador 2', 'password' => Hash::make('entregador'), 'email' => 'entregador2@email.com', 'phone' => '81900000000', 'birthday' => '2019-05-21', 'role' => User::DELIVERYMAN ]
        ];

        User::insert($users);

    }
}
