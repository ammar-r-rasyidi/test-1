<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('companies')->insert(
				array (
				  0 => 
				  array (
				    'id' => 1,
				    'name' => 'Company 1',
				    'email' => 'company_1@test.com',
				    'logo' => 'files_upload/logo/PENDAFTARAN_1622563796.png',
				    'website' => 'company_1.com',
				    'created_at' => '2021-05-26T15:30:57',
				    'updated_at' => '2021-05-26T16:00:27',
				  ),
				  1 => 
				  array (
				    'id' => 2,
				    'name' => 'Company 2',
				    'email' => 'company_2@test.com',
				    'logo' => 'files_upload/logo/verifikasi (1)_1622563766.png',
				    'website' => 'company_2.com',
				    'created_at' => '2021-05-26T16:11:06',
				    'updated_at' => '2021-05-26T16:11:06',
				  ),
				)
      );
    }
}
