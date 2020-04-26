<?php

use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('gender')->delete();

        \DB::table('gender')->insert(array (
            0 =>
            array (

                'name' => 'Men',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (

                'name' => 'Women',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));


    }
}
