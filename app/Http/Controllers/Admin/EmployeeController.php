<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
{
    $employees = User::whereIn('account_type', [
        'admin',
        'kitchen_manager',
        'user_manager',
    ])->latest()->get();

    return view('admin.manage-employees', compact('employees'));
}

    public function create()
    {
        return view('admin.create-employee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'address' => 'required',
            'account_type' => 'required|in:admin,kitchen_manager,user_manager',
            'password' => 'required|min:6',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'account_type' => $request->account_type,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.employees')->with('success', 'Employee added successfully');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);

        return view('admin.edit-employee', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required',
            'address' => 'required',
            'account_type' => 'required|in:admin,kitchen_manager,user_manager',
        ]);

        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'account_type' => $request->account_type,
        ]);

        return redirect()->route('admin.employees')->with('success', 'Employee updated');
    }

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees')->with('success', 'Employee deleted');
    }
}