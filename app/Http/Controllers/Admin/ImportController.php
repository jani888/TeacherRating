<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\GroupsImportJob;
use App\Jobs\SchoolClassesImportJob;
use App\Jobs\StudentGroupsImportJob;
use App\Jobs\TeachersImportJob;
use App\Jobs\UpdateProgressJob;
use App\Jobs\UsersImportJob;
use App\Models\ImportProgress;
use Illuminate\Http\Request;

class ImportController extends Controller {

    public function index() {
        return view('admin.import');
    }

    public function store(Request $request) {
        ini_set('max_execution_time', 30000);
        //Start a new import progress (progress: 0-5 -> 0-100%)
        $importProgress = ImportProgress::create();

        $paths = [
            "students" => $request->file('students')->storeAs('imports', 'students.xslx'),
            "teachers" => $request->file('teachers')->storeAs('imports', 'teachers.xslx'),
            "groups"   => $request->file('groups')->storeAs('imports', 'groups.xslx'),
        ];

        //Import classes
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
        session()->flash('importID', $importProgress->id);
        return back();
    }
}
