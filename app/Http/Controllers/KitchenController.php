<?php

namespace App\Http\Controllers;

class KitchenController extends Controller
{
    public function dashboard()
    {
        return view('kitchen.dashboard');
    }

    public function board()
    {
        return view('kitchen.board');
    }

    public function newOrders()
    {
        return view('kitchen.new-orders');
    }

    public function preparingOrders()
    {
        return view('kitchen.preparing-orders');
    }

    public function readyOrders()
    {
        return view('kitchen.ready-orders');
    }

    public function completedOrders()
    {
        return view('kitchen.completed-orders');
    }
}
