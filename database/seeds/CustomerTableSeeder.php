<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('customer')->delete();

        \DB::table('customer')->insert(array (
            0 =>
            array (

                'name' => 'tám lê văn',
                'gender' => 1,
                'email' => 'letamhot@gmail.com',
                'address' => 'Hồ Đắc Di, Tp Huế',
                'postcode' => '123123',
                'image' => NULL,
                'city' => 'Thừa Thiên Huế',
                'phone' => 127222223,
                'note' => NULL,
                'active' => 0,
                'user_created' => NULL,
                'user_updated' => 'tám lê văn_google',
                'user_deleted' => NULL,
                'users' => NULL,
                'created_at' => '2020-04-23 17:04:44',
                'updated_at' => '2020-04-24 18:01:12',
                'deleted_at' => NULL,
            ),
            1 =>
            array (

                'name' => 'Tám Lê',
                'gender' => NULL,
                'email' => 'levantam160896@gmail.com',
                'address' => 'Tp Huế',
                'postcode' => NULL,
                'image' => NULL,
                'city' => NULL,
                'phone' => 1219072905,
                'note' => NULL,
                'active' => 0,
                'user_created' => NULL,
                'user_updated' => NULL,
                'user_deleted' => NULL,
                'users' => NULL,
                'created_at' => '2020-04-24 20:39:25',
                'updated_at' => '2020-04-24 20:39:25',
                'deleted_at' => NULL,
            ),
        ));


    }
}
