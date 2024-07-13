<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('user', UserController::class);

Route::post('login', [AuthController::class, 'authenticate']);
