<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GroupsImport;
use App\Imports\SchoolClassesImport;
use App\Imports\StudentGroupsImport;
use App\Imports\TeachersImport;
use App\Imports\UsersImport;
use App\Models\Group;
use App\Models\ImportProgress;
use App\Models\Rating;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\User;
use Illuminate\Console\OutputStyle;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportController extends Controller {

    public function index() {
        return view('admin.import');
    }

    public function store(Request $request) {
        $validator = \Validator::make(
            [
                'students'      => $request->students,
                'students_extension' => strtolower($request->students->getClientOriginalExtension()),
                'teachers'      => $request->teachers,
                'teachers_extension' => strtolower($request->teachers->getClientOriginalExtension()),
                'groups'      => $request->groups,
                'groups_extension' => strtolower($request->groups->getClientOriginalExtension()),
            ],
            [
                'students'          => 'required',
                'students_extension'      => 'required|in:xlsx,xls',
                'teachers'          => 'required',
                'teachers_extension'      => 'required|in:xlsx,xls',
                'groups'          => 'required',
                'groups_extension'      => 'required|in:xlsx,xls',
            ]
        );
        $validator->validate();
        User::truncate();
        Teacher::truncate();
        Group::truncate();
        SchoolClass::truncate();
        Rating::truncate();
        ini_set('max_execution_time', 30000);
        //Start a new import progress (progress: 0-5 -> 0-100%)
        $importProgress = ImportProgress::create();

        $paths = [
            "students" => $request->file('students')->storeAs('imports', 'students.xslx'),
            "teachers" => $request->file('teachers')->storeAs('imports', 'teachers.xslx'),
            "groups"   => $request->file('groups')->storeAs('imports', 'groups.xslx'),
        ];

        (new SchoolClassesImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($paths["students"]);
        (new UsersImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($paths["students"]);
        (new TeachersImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($paths["teachers"]);
        (new GroupsImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($paths["teachers"]);
        (new StudentGroupsImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($paths["groups"]);

        /*//Import classes
        SchoolClassesImportJob::withChain([
            //Imports all students
            UsersImportJob::withChain([
                new UpdateProgressJob($importProgress),
            ])->dispatch($paths['students']),
            //Imports all teachers
            TeachersImportJob::withChain([
                new UpdateProgressJob($importProgress),
            ])->dispatch($paths['teachers']),
            //Imports teacher groups
            GroupsImportJob::withChain([
                new UpdateProgressJob($importProgress),
            ])->dispatch($paths['teachers']),
            //Imports student groups
            StudentGroupsImportJob::withChain([
                new UpdateProgressJob($importProgress),
            ])->dispatch($paths['groups']),
            new UpdateProgressJob($importProgress),
        ])->dispatch($paths['students']);
        session()->flash('importID', $importProgress->id);*/
        session()->flash('status', 'success');
        return back();
    }
}
