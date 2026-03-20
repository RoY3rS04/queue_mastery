<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Deploy implements ShouldQueue
{
    use Queueable;

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
        Redis::funnel('deployments')
            ->limit(5)
            ->block(10)
            ->then(function () {
                info('Started deploying...');

                sleep(5);

                info('Finished deploying!');
            });

        // 10 Deploy jobs every 60 seconds
        Redis::throttle('deployments')
            ->allow(10)
            ->every(60)
            ->then(function () {

            });

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

    public function middleware() {
        return [
            new WithoutOverlapping('deployments', 10)
        ];
    }
}
