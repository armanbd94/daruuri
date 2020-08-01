<?php

use App\Model\User;
use Illuminate\Database\Seeder;

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
            'role_id' => 1,
            'name' => 'Mohammad Arman',
            'email' => 'mohammadarman.iiuc.cse@gmail.com',
            'password' => 'Admin@100%'
        ]);
    }
}
