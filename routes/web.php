<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/driver-registration', function () {
    return view('driver-registration');
});

Route::get('/driver-registration-details', function () {
    return view('driver-registration-details');
});

Route::get('/feedback', function () {
    return view('feedback');
});

Route::get('/feedback-details', function () {
    return view('feedback-details');
});

Route::get('/finance-order', function () {
    return view('finance-order');
});

Route::get('/order', function () {
    return view('order-page');
});

Route::get('/order-details', function () {
    return view('order-page-details');
});

Route::get('/vehicle', function () {
    return view('vehicle-page');
});

Route::get('/vehicle-details', function () {
    return view('vehicle-page-details');
});

Route::get('/balance', function () {
    return view('balance');
});

Route::get('/balance-details', function () {
    return view('balance-detail');
});

Route::get('/price-setting', function () {
    return view('price-setting');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/user-management', function () {
    return view('user-management');
});

Route::get('/user-details', function () {
    return view('user-details');
});

