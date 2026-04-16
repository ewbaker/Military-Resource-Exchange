<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Gen. Fred Agbo', 'email' => 'gen.agbo@us.af.mil', 'role' => 'lender'],
            ['name' => 'E-1 Evyn Baker', 'email' => 'e1.baker@us.af.mil', 'role' => 'lender'],
            ['name' => 'E-2 Petros Blankenstein', 'email' => 'e2.blankenstein@us.af.mil', 'role' => 'borrower'],
            ['name' => 'E-3 Ethan Bucy', 'email' => 'e3.bucy@us.af.mil', 'role' => 'borrower'],
            ['name' => 'E-4 Dominic Canale', 'email' => 'e4.canale@us.af.mil', 'role' => 'borrower'],
            ['name' => 'O-5 Sawyer Wilson', 'email' => 'o5.wilson@us.af.mil', 'role' => 'borrower'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(['email' => $u['email']], [
                'name' => $u['name'],
                'password' => Hash::make('password'), // Everyone's password is now: password
                'role' => $u['role'],
            ]);
        }
    }
}