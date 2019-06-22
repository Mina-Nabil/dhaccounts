<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // DB::table('user_types')->insert([
        //     'name' => "admin"
        // ]);
        //
        // DB::table('users')->insert([
        //     'username' => "ashraf",
        //     'fullname' => 'Ashraf Aziz',
        //     'password' => bcrypt('admin'),
        //     'mobNumber' => "01222110131",
        //     'typeID' => 1,
        // ]);
        //
        //Check values with customer
        DB::table('ledger')->insert([
          'LDGR_DATE' => date("Y-m-d H:i:s"),
          'LDGR_CMNT' => "Ledger Initial Balance",
          'LDGR_GD21_CURR' => 2100,
          'LDGR_GD18_CURR' => 1800,
          'LDGR_MONY_CURR' => 300,
          'LDGR_USER_ID' => 1
        ]);

    }
}
