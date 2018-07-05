<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'password' => bcrypt('admin123'),
            'email' => 'admin@gmail.com',
            'role_type' => 1,
            'ins_id' => 1,
        ]);
    }
}
