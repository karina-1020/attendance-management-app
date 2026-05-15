<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::all();


        return view('admin.staff.list', compact('users'));
    }

    public function show($id)
    {
        $staff = User::with('attendances')->findOrFail($id);

        return view('admin.staff.show', compact('staff'));
    }
}
