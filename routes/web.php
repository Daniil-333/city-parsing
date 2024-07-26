<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


include __DIR__.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'front.php';

Route::prefix('{locales?}')
    ->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('main');
        include __DIR__.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'front.php';
    });
