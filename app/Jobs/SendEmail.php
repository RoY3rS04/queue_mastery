<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 10;
    public int $maxExceptions = 3;
//    public array $backoff = [2, 10, 20];

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        throw new \Exception('failed!');

        return $this->release();
    }

    public function failed($e) {
        info('Failed!');
    }
}
