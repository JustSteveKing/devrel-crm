<?php

declare(strict_types=1);

use App\Http\Controllers\Contacts;
use Illuminate\Support\Facades\Route;

Route::get('/', Contacts\IndexController::class)->name('index');
