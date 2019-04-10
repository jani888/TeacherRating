<?php

namespace App\Console\Commands;

use App\Imports\GroupsImport;
use App\Imports\TeachersImport;
use Illuminate\Console\Command;

class ImportTeachersCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teachers {file}';

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
        $this->output->title("Teachers import stated");
        (new TeachersImport)->withOutput($this->output)->import($this->argument('file'));
        $this->output->success("Teachers imported successfully");

        //Imports teacher groups
        $this->output->title("Teacher groups import stated");
        (new GroupsImport)->withOutput($this->output)->import($this->argument('file'));
        $this->output->success("Teacher groups imported successfully");
    }
}
