<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('employees')->insert(
				array (
				  0 => 
				  array (
				    'id' => 1,
				    'first_name' => 'jhon',
				    'last_name' => 'doe 1',
				    'company_id' => 1,
				    'website' => NULL,
				    'phone' => '1234567890',
				    'email' => 'john.doe.1@test.com',
				    'created_at' => '2021-05-26T17:17:44',
				    'updated_at' => '2021-05-26T17:17:44'
				  ),
				)
			);
    }
}
