<?php

/* use App\Models\User;
use App\Models\Tenant; */

use App\Models\{
    Tenant,
    User
};
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenant = Tenant::first();


        $tenant->users()->create([
            'name' => 'Diego Card',
            'email' => 'diegocar448@hotmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
