<?php

namespace Database\Seeders;

use App\Models\Catering;
use App\Models\Menu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run()
    {
        $userId = [Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString(),Str::uuid()->toString()];
        User::create([
            'id' => $userId[0],
            'email' => 'admin@gmail.com',
            'phone_number' => '083831001231',
            'username' => 'admin',
            'fullname' => 'admin',
            'password' => bcrypt('admin123'),
            'gender' => 'male',
            'dob' => Carbon::parse('2003-07-05'),
            'role' => 'admin',
            'status' => 'active'
        ]);
        User::create([
            'id' => $userId[1],
            'email' => 'guido@gmail.com',
            'phone_number' => '083831231231',
            'username' => 'guidoFX',
            'fullname' => 'Guido William',
            'password' => bcrypt('guido123'),
            'gender' => 'male',
            'dob' => Carbon::parse('2003-11-11'),
            'role' => 'customer',
            'status' => 'active'
        ]);

        User::create([
            'id' => $userId[2],
            'email' => 'vije@gmail.com',
            'phone_number' => '083831231231',
            'username' => 'vijeck',
            'fullname' => 'vincetius J',
            'password' => bcrypt('vijeck123'),
            'gender' => 'male',
            'dob' => Carbon::parse('2003-05-11'),
            'role' => 'seller',
            'status' => 'active'
        ]);

        return $userId;
    }
}
