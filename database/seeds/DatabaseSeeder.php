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
        $this->call(UsersTableSeeder::class);
        // // $this->call(ProductTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(ProducerTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TypeTableSeeder::class);

        $this->call(CustomerTableSeeder::class);
    }
}
