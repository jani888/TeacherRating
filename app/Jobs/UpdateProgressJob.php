<?php

namespace App\Jobs;

use App\Models\ImportProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateProgressJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ImportProgress
     */
    private $progress;

    /**
     * Create a new job instance.
     *
     * @param ImportProgress $progress
     */
    public function __construct(ImportProgress $progress)
    {
        $this->progress = $progress;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->progress->progress++;
        $this->progress->save();
    }
}
