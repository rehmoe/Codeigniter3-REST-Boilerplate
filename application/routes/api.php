<?php

// ----------------------------- SESSIONS API ---------------------------------
Route::resource('sessions', 'SessionController', [
    'index',   // All records
    'show',    // Single record
    'destroy', // Delete record
]);
