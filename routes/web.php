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

    $batch = [
        new \App\Jobs\PullRepo('laracasts/project1'),
        new \App\Jobs\PullRepo('laracasts/project2'),
        new \App\Jobs\PullRepo('laracasts/project3')
    ];

    //Bus::chain($chain)->dispatch();

    // Processes the jobs in parallel
    \Illuminate\Support\Facades\Bus::batch($batch)
        ->allowFailures()
        ->dispatch();

    return view('welcome');
});
