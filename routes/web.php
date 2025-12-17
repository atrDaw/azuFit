<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/welcome2', function () {
    return view('welcome2');
});
Route::get('/welcome', function () {
    return view('welcome');
});
