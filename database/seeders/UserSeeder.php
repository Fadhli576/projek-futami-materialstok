<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Walter White',
            'role_id' => 3,
            'address' => 'Alburqueque',
            'email' => 'walter@gmail.com',
            'password' => bcrypt('walter123'),
            'no_hp' => '082110859217'
        ]);

        User::create([
            'name' => 'Admin',
            'role_id' => 2,
            'address' => 'Bogor',
            'email' => 'irwan.ruswandi@futami.co.id',
            'password' => bcrypt('123456'),
            'no_hp' => '085697600696'
        ]);

        User::create([
            'name' => 'Ilham',
            'role_id' => 1,
            'address' => 'Bogor',
            'email' => 'admin.engineering@futami.co.id',
            'password' => bcrypt('123456'),
            'no_hp' => '085723020340'
        ]);
    }
}
