<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
// Luthier-CI
$hook = Luthier\Hook::getHooks();

/**
 * ----------------------------------------------------------------------------
 * Whoops Error Handler/Exception Handling
 * ----------------------------------------------------------------------------
 * This will load Whoops Error / Exception Handling on a `pre_system` flight
 *
 * @link https://github.com/filp/whoops
 */
$hook['pre_system'][] = [
    'class'    => 'WhoopsHook',
    'function' => 'bootWhoops',
    'filename' => 'WhoopsHook.php',
    'filepath' => 'hooks', // Change if different from APPPATH/hooks/
    'params'   => [],
];

// ----------------------------------------------------------------------------

/**
 * ----------------------------------------------------------------------------
 * PhpDotEnv Hook
 * ----------------------------------------------------------------------------
 * This will load PHpDotEnv Environmental Variables on a `pre_system` flight
 *
 * @link https://github.com/vlucas/phpdotenv
 */
$hook['pre_system'][] = [
    'class'    => 'DotEnvHook',
    'function' => 'bootDotEnv',
    'filename' => 'DotEnvHook.php',
    'filepath' => 'hooks',
    'params'   => [],
];

