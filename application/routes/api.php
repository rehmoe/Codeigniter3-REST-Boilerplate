<?php

// ----------------------------- SESSIONS API ---------------------------------
// Example resource routes for the `ci_sessions` database table
Route::resource('sessions', 'SessionController', [
    'index',   // All records
    'show',    // Single record
    'destroy', // Delete record
]);

// ----------------------------- JWT EXAMPLES ---------------------------------
// Example routes for demonstrating the built-in JWT Library
Route::group('/jwt', function() {
    Route::get('/encode/{any:key}', 'JWTController@encode');
    Route::get('/decode/{any:jwt}', 'JWTController@decode');
});
