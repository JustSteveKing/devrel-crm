<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', fn (Request $request) => $request->user());

Route::prefix('auth')->as('auth:')->group(base_path(
    path: 'routes/api/auth.php',
));

Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::prefix('contacts')->as('contacts:')->group(base_path(
        path: 'routes/api/contacts.php',
    ));
});
