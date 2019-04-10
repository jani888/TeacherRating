<?php

namespace App\Console\Commands;

use App\Imports\SchoolClassesImport;
use App\Imports\UsersImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:students {file}';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->output->title("Classes import stated");
        (new SchoolClassesImport)->withOutput($this->output)->import($this->argument('file'));
        $this->output->success("Classes imported successfully");

        $this->output->createProgressBar();

        $this->output->title("Users import stated");
        (new UsersImport)->withOutput($this->output)->import($this->argument('file'));
        $this->output->success("Users imported successfully");
    }
}
