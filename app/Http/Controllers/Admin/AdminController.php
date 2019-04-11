<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::all();
        return view('admin.admins', compact('admins'));
    }

    public function edit(Admin $admin) {
        return view('admin.admins_edit', compact('admin'));
    }

    public function create(Request $request) {
        return view('admin.admins_create');
    }

    public function store(Request $request) {
        Admin::forceCreate(['name' => $request->name, 'username' => $request->username, 'password' => bcrypt($request->password)]);
        return back();
    }

    public function delete(Admin $admin) {
        $admin->delete();
        return back();
    }

    public function update(Admin $admin, Request $request) {
        $admin->update($request->only(['name', ['username']]));
        return back();
    }
}
