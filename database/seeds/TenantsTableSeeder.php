<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '2121321213',
            'name' => 'DiegoTech',
            'url' => 'diegotech',
            'email' => 'diegocar448@hotmail.com',
        ]);
    }
}
