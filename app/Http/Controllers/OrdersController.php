<?php

namespace App\Http\Controllers;

class OrdersController extends Controller
{
    public function create()
    {
        return view('new_orders.new-orders');
    }

    public function preparation()
    {
        return view('preparation.preparing-orders');
    }

    public function ready()
    {
        return view('ready_orders.ready-orders');
    }
}
