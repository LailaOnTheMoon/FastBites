<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function dashboard()
    {
        $totalUsers = Customer::count();

        $newUsers = Customer::whereDate('created_at', today())->count();

        $activeUsersCount = Customer::whereNotNull('email_verified_at')->count();

        $activeUsers = $totalUsers > 0
            ? round(($activeUsersCount / $totalUsers) * 100) . '%'
            : '0%';

        $verifiedProfiles = $totalUsers > 0
            ? round((Customer::whereNotNull('email_verified_at')->count() / $totalUsers) * 100) . '%'
            : '0%';

        $profilesUnderReview = Customer::whereNull('email_verified_at')->count();

        $roleUpdatesPending = Customer::where(function ($query) {
            $query->whereNull('phone_number')
                ->orWhereNull('address_line_1');
        })->count();

        $reportsOpen = Customer::where(function ($query) {
            $query->whereNull('email_verified_at')
                ->orWhereNull('phone_number')
                ->orWhereNull('address_line_1');
        })->count();

        return view('user-management.dashboard', compact(
            'totalUsers',
            'newUsers',
            'activeUsers',
            'reportsOpen',
            'verifiedProfiles',
            'profilesUnderReview',
            'roleUpdatesPending'
        ));
    }

    public function allUsers()
    {
        $users = Customer::latest()->get();

        return view('user-management.all-users', compact('users'));
    }

    public function userProfiles()
    {
        $totalUsers = Customer::count();

        $completedProfiles = Customer::whereNotNull('phone_number')
            ->whereNotNull('address_line_1')
            ->count();

        $completedProfilesPercent = $totalUsers > 0
            ? round(($completedProfiles / $totalUsers) * 100)
            : 0;

        $verifiedContacts = Customer::whereNotNull('email_verified_at')->count();

        $verifiedContactsPercent = $totalUsers > 0
            ? round(($verifiedContacts / $totalUsers) * 100)
            : 0;

        $profilesNeedingUpdates = Customer::where(function ($query) {
            $query->whereNull('phone_number')
                ->orWhereNull('address_line_1');
        })->count();

        return view('user-management.user-profiles', compact(
            'completedProfilesPercent',
            'verifiedContactsPercent',
            'profilesNeedingUpdates'
        ));
    }

    public function userReports()
    {
        $usersMissingPhone = Customer::whereNull('phone_number')->count();
        $usersMissingAddress = Customer::whereNull('address_line_1')->count();
        $usersUnverified = Customer::whereNull('email_verified_at')->count();

        return view('user-management.user-reports', compact(
            'usersMissingPhone',
            'usersMissingAddress',
            'usersUnverified'
        ));
    }

    public function edit($id)
    {
        $user = Customer::findOrFail($id);

        return view('user-management.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Customer::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address_line_1' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()
            ->route('user-management.all-users')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $user = Customer::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('user-management.all-users')
            ->with('success', 'Customer deleted successfully.');
    }
}