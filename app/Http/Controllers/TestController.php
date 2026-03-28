<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function viewTest()
    {
        // give the test a name Hanaa
        $name = 'Hanaa';
        return view('test', [
            'name' => $name
        ]);
    }
}