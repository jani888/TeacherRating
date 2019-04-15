<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\GroupsImport;
use App\Imports\SchoolClassesImport;
use App\Imports\StudentGroupsImport;
use App\Imports\TeachersImport;
use App\Imports\UsersImport;
use App\Jobs\GroupsImportJob;
use App\Jobs\SchoolClassesImportJob;
use App\Jobs\StudentGroupsImportJob;
use App\Jobs\TeachersImportJob;
use App\Jobs\UpdateProgressJob;
use App\Jobs\UsersImportJob;
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
        return back();
    }
}
