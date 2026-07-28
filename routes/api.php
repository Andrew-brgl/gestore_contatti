<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route group for contact
Route::group(['prefix' => 'contacts'], function () {

    Route::post('/', [ContactController::class, 'create']);
    Route::patch('/update', [ContactController::class, 'updateContact']); // update only specific fields
    Route::get('/search', [ContactController::class, 'searchContacts']);
    Route::get('/all', [ContactController::class, 'getAllContacts']);
    Route::get('/{id}', [ContactController::class, 'getContact'])->whereNumber('id');
    Route::patch('/{id}/invalidate', [ContactController::class, 'invalidate'])->whereNumber('id');
});
