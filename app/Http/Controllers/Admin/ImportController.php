<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GroupsImport;
use App\Imports\SchoolClassesImport;
use App\Imports\StudentGroupsImport;
use App\Imports\TeachersImport;
use App\Imports\UsersImport;
use App\Models\Group;
use App\Models\Rating;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\User;
use Illuminate\Console\OutputStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportController extends Controller {

    public function index() {
        return view('admin.import');
    }

    public function store(Request $request) {
        $validator = \Validator::make([
            'students'           => $request->students,
            'students_extension' => strtolower($request->students->getClientOriginalExtension()),
            'teachers'           => $request->teachers,
            'teachers_extension' => strtolower($request->teachers->getClientOriginalExtension()),
            'groups'             => $request->groups,
            'groups_extension'   => strtolower($request->groups->getClientOriginalExtension()),
        ], [
            'students'           => 'required',
            'students_extension' => 'required|in:xlsx,xls',
            'teachers'           => 'required',
            'teachers_extension' => 'required|in:xlsx,xls',
            'groups'             => 'required',
            'groups_extension'   => 'required|in:xlsx,xls',
        ]);
        $validator->validate();
        User::truncate();
        Teacher::truncate();
        Group::truncate();
        SchoolClass::truncate();
        Rating::truncate();
        \DB::table('group_teacher')->truncate();
        \DB::table('group_user')->truncate();
        ini_set('max_execution_time', 30000);
        $paths = [
            "students" => $request->file('students')->storeAs('imports', 'students.xslx'),
            "teachers" => $request->file('teachers')->storeAs('imports', 'teachers.xslx'),
            "groups"   => $request->file('groups')->storeAs('imports', 'groups.xslx'),
        ];

        $fakeOutput = new OutputStyle(new ArrayInput([]), new ConsoleOutput());
        (new SchoolClassesImport)->withOutput($fakeOutput)->import($paths["students"]);
        (new UsersImport)->withOutput($fakeOutput)->import($paths["students"]);
        (new TeachersImport)->withOutput($fakeOutput)->import($paths["teachers"]);
        (new GroupsImport)->withOutput($fakeOutput)->import($paths["teachers"]);
        (new StudentGroupsImport)->withOutput($fakeOutput)->import($paths["groups"]);

        //Count all inserted rows by table
        $count = [];
        $count[] = DB::table('users')->count();
        $count[] = DB::table('teachers')->count();
        $count[] = DB::table('school_classes')->count();
        $count[] = DB::table('groups')->count();
        $count[] = DB::table('group_user')->count();
        $count[] = DB::table('group_teacher')->count();
        //filter tables with no rows
        $noRowsInserted = array_filter($count, function ($table) {
            return $table == 0;
        });
        if (count($noRowsInserted) > 0) {
            return 'warning';
        }

        return 'success';
    }
}
