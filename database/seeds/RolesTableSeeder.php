<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // generate the default user roles
        DB::table('roles')->insert([
            [
                'handle' => 'super-admin',
                'name' => 'Super Admin',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                'handle' => 'admin',
                'name' => 'Admin',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                'handle' => 'buyer',
                'name' => 'Buyer',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
            [
                'handle' => 'supplier',
                'name' => 'Supplier',
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ],
        ]);
    }
}
