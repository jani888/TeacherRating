<?php

namespace App\Jobs;

use App\Imports\SchoolClassesImport;
use App\Imports\StudentGroupsImport;
use App\Imports\UsersImport;
use Illuminate\Bus\Queueable;
use Illuminate\Console\OutputStyle;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

class UsersImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        //
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new UsersImport)->withOutput(new OutputStyle(new ArrayInput([]), new ConsoleOutput()))->import($this->file);
    }
}
