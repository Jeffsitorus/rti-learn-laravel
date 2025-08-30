<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::group(['namespace' => 'App\Http\Controllers'], function ($route) {
    $route->prefix('tags')->group(function ($route) {
        $route->get('/', [TagController::class, 'index']);
        $route->post('/', [TagController::class, 'store']);
        $route->get('/all', [TagController::class, 'all']);
        $route->get('/{tag:id}', [TagController::class, 'show']);
        $route->patch('/{tag:id}', [TagController::class, 'update']);
    });
});
