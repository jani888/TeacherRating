<?php

namespace App\Http\Controllers\Admin;

use App\Imports\GroupsImport;
use App\Imports\StudentGroupsImport;
use App\Imports\TeachersImport;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index() {
        return view('admin.import');
    }

    public function store(Request $request) {
        //Imports all students
        Excel::import(new UsersImport, $request->file('students'));
        //Imports all teachers
        Excel::import(new TeachersImport, $request->file('teachers'));
        //Imports teacher groups
        Excel::import(new GroupsImport, $request->file('teachers'));
        //Imports student groups
        Excel::import(new StudentGroupsImport, $request->file('groups'));
    }
}
