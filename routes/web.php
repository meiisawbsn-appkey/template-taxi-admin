<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard-new');
})->name('dashboard');

Route::get('/driver-registration', function () {
    return view('driver-registration-new');
})->name('driver-registration');

Route::get('/driver-registration-details', function () {
    return view('driver-registration-details-new');
})->name('driver-registration-details');

Route::get('/feedback', function () {
    return view('feedback-new');
})->name('feedback');

Route::get('/feedback-details', function () {
    return view('feedback-details-new');
})->name('feedback-details');

Route::get('/finance-order', function () {
    return view('finance-order-new');
})->name('finance-order');

Route::get('/order', function () {
    return view('order-page-new');
})->name('order');

Route::get('/order-details', function () {
    return view('order-page-details-new');
})->name('order-details');

Route::get('/vehicle', function () {
    return view('vehicle-page-new');
})->name('vehicle');

Route::get('/vehicle-details', function () {
    return view('vehicle-page-details-new');
})->name('vehicle-details');

Route::get('/balance', function () {
    return view('balance-new');
})->name('balance');

Route::get('/balance-details', function () {
    return view('balance-detail-new');
})->name('balance-details');

Route::get('/price-setting', function () {
    return view('price-setting-new');
})->name('price-setting');

Route::get('/login', function () {
    return view('login-new');
})->name('login');

Route::get('/user-management', function () {
    return view('user-management-new');
})->name('user-management');

Route::get('/user-details', function () {
    return view('user-details-new');
})->name('user-details');

