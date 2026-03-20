<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

//    foreach (range(1, 100) as $i) {
//        \App\Jobs\SendEmail::dispatch();
//    }

//    \App\Jobs\SendEmail::dispatch();

//    \App\Jobs\ProcessPayment::dispatch()
//        ->onQueue('payments');

    // Dispatching a workflow
//    $chain = [
//        new \App\Jobs\PullRepo(),
//        new \App\Jobs\RunTests(),
//        new \App\Jobs\Deploy()
//    ];

    // A batch of chains
//    $batch = [
//        [
//            new \App\Jobs\PullRepo('laracasts/project1'),
//            new \App\Jobs\RunTests('laracasts/project1'),
//            new \App\Jobs\Deploy('laracasts/project1')
//        ],
//        [
//            new \App\Jobs\PullRepo('laracasts/project2'),
//            new \App\Jobs\RunTests('laracasts/project2'),
//            new \App\Jobs\Deploy('laracasts/project2')
//        ]
//    ];

    \App\Jobs\Deploy::dispatch();

//    Bus::chain([
//        new \App\Jobs\Deploy(),
//        function () {
//            \Illuminate\Support\Facades\Bus::batch([...])->dispatch();
//        }
//    ])->dispatch();

    // Processes the jobs in parallel
//    \Illuminate\Support\Facades\Bus::batch($batch)
//        ->catch(function ($batch, $e) {
//
//        })
//        ->then(function ($batch) {
//
//        })
//        ->finally(function ($batch) {
//
//        })
//        ->onQueue('deployments')
////        ->onConnection('database')
//        ->allowFailures()
//        ->dispatch();

    return view('welcome');
});
