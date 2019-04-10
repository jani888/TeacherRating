<?php

namespace App\Console\Commands;

use App\Imports\GroupsImport;
use App\Imports\StudentGroupsImport;
use App\Imports\TeachersImport;
use Illuminate\Console\Command;

class ImportGroupsCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:groups {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //Imports all teachers
        $this->output->title("Student groups import stated");
        (new StudentGroupsImport)->withOutput($this->output)->import($this->argument('file'));
        $this->output->success("Student groups imported successfully");
    }
}
