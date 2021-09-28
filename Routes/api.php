<?php

use Includes\ApiController;
use Includes\Route;


Route::add('/api/v1/cart', function () {
    return ApiController::store();
}, 'post');
Route::add('/api/v1/cart', function () {
    return ApiController::index();
}, 'get');
Route::run('/');
Route::run('/api/v1');
