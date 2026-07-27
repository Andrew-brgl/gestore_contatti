<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TitleController;

Route::get('/', function () {
    return view('home');
});

//Route group for contact
Route::group(['prefix' => 'contact'], function () {
    
    Route::get('/prova', [ContactController::class, 'prova']);
    Route::apiResource('/', ContactController::class);
});