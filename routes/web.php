<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    foreach (range(1, 100) as $i) {
        \App\Jobs\SendEmail::dispatch();
    }

    \App\Jobs\ProcessPayment::dispatch()
        ->onQueue('payments');

    return view('welcome');
});
