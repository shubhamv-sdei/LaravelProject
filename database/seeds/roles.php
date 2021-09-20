<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $data = [
          [ 'name' => 'Physician' ],
          [ 'name' => 'Patient' ],
          [ 'name' => 'Family & Friends' ],
          [ 'name' => 'Sponsors' ],
	       	[ 'name' => 'Principal Investigator' ],
          [ 'name' => 'Super Admin' ],
          [ 'name' => 'UnAssigned' ],
       ];
       DB::table('roles')->insert($data);
    }
}
