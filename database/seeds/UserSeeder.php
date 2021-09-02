<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,10)->create();
        App\User::create([
            'name' => 'Aldo',
            'email' => 'aldo@admin.com',
            'password' => bcrypt('123456')
        ]);
    }
}
