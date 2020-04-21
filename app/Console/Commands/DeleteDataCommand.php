<?php

namespace App\Console\Commands;

use App\Exports\DatabaseExport;
use App\Imports\GroupsImport;
use App\Imports\TeachersImport;
use App\Models\Group;
use App\Models\Rating;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DeleteDataCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all data from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        /*if(!$this->confirm('Biztos törölni szeretnél minden adatot?')){
            $this->warn('Adatok nem kerültek törlésre');
        }*/
/*
        $students = User::all();
        $teachers = Teacher::all();
        $groups = Group::all();
        $classes = SchoolClass::all();
        $ratings = Rating::all();
        $groupTeacher = \DB::table('group_teacher')->get();
        $groupStudent = \DB::table('group_user')->get();

        $filename = sprintf("database-%s.xlsx", Carbon::now()->format('Ymd-His'));
        Excel::store(new DatabaseExport(collect(compact('students', 'teachers', 'groups', 'classes', 'ratings', 'groupStudent', 'groupTeacher'))), $filename);
        $this->info("Adatbázis elmentve (" . Storage::url($filename) . ")");
*/
        User::truncate();
        Teacher::truncate();
        Group::truncate();
        SchoolClass::truncate();
        Rating::truncate();
        \DB::table('group_teacher')->truncate();
        \DB::table('group_user')->truncate();
        $this->warn("Adatbázis kiürítve");
    }
}
