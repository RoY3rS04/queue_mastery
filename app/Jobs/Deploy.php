<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Deploy implements ShouldQueue, ShouldBeUnique //, ShouldBeUniqueUntilProcessing
{
    use Queueable;

    public $connection = 'redis';
    public $queue = 'deployments';
    public $backoff = 5; // Or array or method
    public $timeout = 60;
    public $tries = 3;
    public $delay = 300;
    public $afterCommit = true;
    public $shouldBeEncrypted = true;

    public $uniqueId = 'products';
    public $uniqueFor = 10;

    // The job will fail if an eloquent model couldn't be found when deserializing thus leading to the job to be deleted from the queue
    public $deleteWhenMissingModels = true;

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
    public function handle(): void
    {
        info('Started deploying...');

        sleep(5);

        info('Finished deploying!');

        //Using Redis funnels
//        Redis::funnel('deployments')
//            ->limit(5)
//            ->block(10)
//            ->then(function () {
//                info('Started deploying...');
//
//                sleep(5);
//
//                info('Finished deploying!');
//            });
//
//        // 10 Deploy jobs every 60 seconds
//        Redis::throttle('deployments')
//            ->allow(10)
//            ->every(60)
//            ->then(function () {
//
//            });

        // Using Locks
//        Cache::lock('deployments')
//            ->block(10, function () {
//                info('Started deploying...');
//
//                sleep(5);
//
//                info('Finished deploying!');
//            });
    }

    public function uniqueId(): string {
        return 'deployments';
    }

    public function uniqueFor(): int
    {
        return 60;
    }

    public function middleware() {
        return [
            //new WithoutOverlapping('deployments', 10)
            new ThrottlesExceptions(10) //Prevent jobs to run after 10 failures
        ];
    }

    public function retryUntil() {
        return \Illuminate\Support\now()->addDay();
    }
}
