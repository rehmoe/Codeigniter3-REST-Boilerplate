<?php

/**
 * HTTP Based Routing
 *
 * @link https://www.codeigniter.com/userguide3/general/routing.html
 * @link https://github.com/ingeniasoftware/luthier-ci
 */

// `Default Controller` Routes
Route::group('/', function() {
    Route::get('/',           'HomeController@index_get');
    Route::get('/home',       'HomeController@index_get');
    Route::get('/home/index', 'HomeController@index_get');
});

// `404 Override`
Route::set('404_override', function () {
    // Using the \CI_Output class we can get the response data set
    ci()->output
        ->set_content_type('application/json')
        ->set_status_header(HTTP_NOT_FOUND);

    // Then we can echo the encoded JSON message
    echo json_encode([
        'message' => 'Resource not found',
        'success' => false,
        'status' => HTTP_NOT_FOUND
    ], JSON_PRETTY_PRINT);
});

// Translate URI Dashes?
Route::set('translate_uri_dashes', false);
