<?php defined('BASEPATH') || exit('Access Denied');

// IMPORT DEPENDENCIES --------------------------------------------------------
use Dotenv\Dotenv;

/**
 * The DotEnvHook Class is used to hook into the pre_system in order to load the
 * vlucas/phpdotenv library.
 *
 * @package  Hooks
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @license  MIT License
 */
class DotEnvHook
{
    /**
     * The \Dotenv library instance
     *
     * @var Dotenv\Dotenv
     */
    protected $dotEnv;

    // ------------------------------------------------------------------------

    /**
     * Let's get PHP DotEnv setup and initialized
     *
     * @return void
     */
    public function bootDotEnv(): void
    {
        // Load the file
        $this->dotEnv = new Dotenv(FCPATH, '.env');
        // Load PhpDotEnv
        $this->dotEnv->load();
    }

    // ------------------------------------------------------------------------
}
