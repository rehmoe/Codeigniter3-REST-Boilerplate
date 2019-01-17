<?php defined('BASEPATH') OR exit(HTTP_FORBIDDEN);

/*
 *  ---------------------------------------------------------------------------
 *  URI ROUTING
 *  ---------------------------------------------------------------------------
 *  All application routing will now be done in the APPPATH/routes/*.php files
 */
$route['default_controller'] = 'HomeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Luthier-CI
$route = Luthier\Route::getRoutes();
