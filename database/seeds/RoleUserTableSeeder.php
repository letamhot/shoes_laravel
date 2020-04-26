<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('role_user')->delete();

        \DB::table('role_user')->insert(array (
            0 =>
            array (

                'role_id' => 1,
                'user_id' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (

                'role_id' => 2,
                'user_id' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (

                'role_id' => 1,
                'user_id' => 19,
                'created_at' => '2020-04-24 18:47:36',
                'updated_at' => '2020-04-24 18:47:36',
            ),
        ));


    }
}
