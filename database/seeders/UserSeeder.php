<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'first_name'        => 'John',
                'middle_name'       => 'Smith',
                'last_name'         => 'Doe',
                'email_address'     => 'johndoe@gmail.com',
                'username'          => 'johndoe',
                'password'          => Hash::make('aDmin123@', ['rounds' => '12']),
                'contact_no'        => '09123456789',
                'position'          => 'Administrator',
                'role'              => 1, // 1 = admin, 2 = staff
                'status'            => 1, // 1 = active, 2 = inactive
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => date('Y-m-d H:i:s') // now
            ],
            [
                'first_name'        => 'Jane',
                'middle_name'       => 'Dee',
                'last_name'         => 'Buffalo',
                'email_address'     => 'janedee@gmail.com',
                'username'          => 'janedee',
                'password'          => Hash::make('sTaff123@', ['rounds' => '12']),
                'contact_no'        => '09123456789',
                'position'          => 'Staff',
                'role'              => 2, // 1 = admin, 2 = staff
                'status'            => 1, // 1 = active, 2 = inactive
                'token'             => null,
                'token_expired_at'  => null,
                'email_verified_at' => date('Y-m-d H:i:s') // now
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
