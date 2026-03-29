<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Laila',
            'middle_name' => 'Smith',
            'last_name' => 'Johnson',
            'email' => 'laila@fastbites.ps',
            'account_type' => 'admin',
            'phone_number' => '972598111111',
            'address' => 'Tulkarm',
            'password' => Hash::make('123'),
        ]);
    }
}
