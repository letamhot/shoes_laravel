<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 18,
                'name' => 'tám lê văn_google',
                'email' => 'letamhot@gmail.com',
                'provider' => 'google',
                'provider_id' => '108655503165349077077',
                'image' => 'https://lh3.googleusercontent.com/a-/AOh14GjMhwxVxfBFJfjbRmkl-PTI_e4U19KCZG9uDIOS',
                'gender' => NULL,
                'address' => NULL,
                'phone' => NULL,
                'email_verified_at' => '2020-04-24 12:33:47',
                'password' => '$2y$10$RsXNNm/Bgg1wlifX2f2fpuLkWPcc7pBBynaVgCaGEQtrgaSPlG1ey',
                'id_role' => NULL,
                'remember_token' => 'cBPxq53WI1QDKacoxvg8s7sg3hXcKuO3s885buf6IXsPEclrRebG65O8qlTq',
                'created_at' => '2020-04-24 12:33:47',
                'updated_at' => '2020-04-24 18:56:20',
            ),
            1 => 
            array (
                'id' => 19,
                'name' => 'Tám Lê',
                'email' => 'levantam160896@gmail.com',
                'provider' => 'google',
                'provider_id' => '114557046552206218672',
                'image' => 'https://lh3.googleusercontent.com/a-/AOh14GjOcULzgI7du_336xfo0CknQ3kV_JRVF41sBBPY',
                'gender' => NULL,
                'address' => 'Tp Huế',
                'phone' => '01219072905',
                'email_verified_at' => '2020-04-24 18:28:45',
                'password' => '$2y$10$cZbX9TI5fmoNmXXbO8zXAOyKLhB1onk7f9ZSSOSVdNU8elnqr84t.',
                'id_role' => NULL,
                'remember_token' => NULL,
                'created_at' => '2020-04-24 18:28:45',
                'updated_at' => '2020-04-24 20:38:45',
            ),
        ));
        
        
    }
}