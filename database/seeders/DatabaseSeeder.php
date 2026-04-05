<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'hana@fastbites.ps'],
            [
                'first_name' => 'Hana',
                'middle_name' => 'Ahmed',
                'last_name' => 'Yasin',
                'phone_number' => '0599999000',
                'address' => 'Tulkarm',
                'account_type' => User::ROLE_SUPER_ADMIN,
                'password' => Hash::make('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'laila@fastbites.ps'],
            [
                'first_name' => 'Laila',
                'middle_name' => 'Ahmed',
                'last_name' => 'Khan',
                'phone_number' => '972598111111',
                'address' => 'Tulkarm',
                'account_type' => User::ROLE_ADMIN,
                'password' => Hash::make('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'tasbeeh@fastbites.ps'],
            [
                'first_name' => 'Tasbeeh',
                'middle_name' => 'Ahmed',
                'last_name' => 'Khan',
                'phone_number' => '0599999111',
                'address' => 'Tulkarm',
                'account_type' => User::ROLE_KITCHEN_MANAGER,
                'password' => Hash::make('12345678'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'sadeel@fastbites.ps'],
            [
                'first_name' => 'Sadeel',
                'middle_name' => 'Ahmed',
                'last_name' => 'Khan',
                'phone_number' => '0599999222',
                'address' => 'Tulkarm',
                'account_type' => User::ROLE_USER_MANAGER,
                'password' => Hash::make('12345678'),
            ]
        );
    }
}