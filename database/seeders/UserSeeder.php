<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Models\User([
            'name' => 'admin',
            'fname' => 'null',
            'lname' => 'null',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        $user->save();
    }
}
