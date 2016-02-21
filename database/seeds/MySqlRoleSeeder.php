<?php

use Illuminate\Database\Seeder;

class MySqlRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new \App\Role();
        $role->create([
            'name' => 'buyer'
        ]);

        $role->create([
            'name' => 'seller'
        ]);
    }
}
