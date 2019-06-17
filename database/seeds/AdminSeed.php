<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'id' => 1,
        'full_name' => 'خانوم بقایی',
        'password' => '1234',
      ]);
    }
}
