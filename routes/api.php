<?php

use App\Http\Controllers\CategoryController;
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

    $route->prefix('tags')->group(function ($route) {
        $route->get('/', [CategoryController::class, 'index']);
        $route->post('/', [CategoryController::class, 'store']);
        $route->get('/all', [CategoryController::class, 'all']);
        $route->get('/{tag:id}', [CategoryController::class, 'show']);
        $route->patch('/{tag:id}', [CategoryController::class, 'update']);
    });
});
