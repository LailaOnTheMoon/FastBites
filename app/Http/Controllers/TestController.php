<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{
    public function viewTest()
    {
        //Fetch data from database
        $user = User::where('id', 1)->first(); //Model
        if(!$user) {
            return view('test', [
                'full_name' => 'User not found',
                'email' => 'User not found',
            ]);
        }

        return view('test', [
            'full_name' => $user->full_name,
            'email' => $user->email,
        ]);
    }

    public function updateUser()
    {
        $user = User::where('id', 1)->first();
        if($user) {
            $user->update([
                'first_name' => 'Laila',
                'middle_name' => 'Ahmed',
                'last_name' => 'Khan',
                'email' => 'laila@fastbites.ps',
            ]);
        }

        return view('test', [
            'first_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'full_name' => $user->full_name,
            'email' => $user->email,
        ]);
    }

    public function createUser()
    {
        $user = User::updateorcreate([
            'email' => 'tasbeeh@fastbites.ps',
        ], [
            'first_name' => 'Tasbeeh',
            'middle_name' => 'Ahmed',
            'last_name' => 'Khan',
            'password' => bcrypt('123'),
            'account_type' => 'admin',
            'address' => 'Tulkarm',
            'phone_number' => '0599999111',
        ]);

        return view('welcome');
    }

}