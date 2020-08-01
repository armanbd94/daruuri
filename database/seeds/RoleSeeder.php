<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $role_name = [
        ['role' => 'Super Admin'],
        ['role' => 'Admin'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert($this->role_name);
    }
}
