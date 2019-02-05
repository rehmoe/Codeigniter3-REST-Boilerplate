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
 * @link     https://github.com/vlucas/phpdotenv
 */
class DotEnvHook
{
    /**
     * The \Dotenv library instance
     *
     * @var \Dotenv\Dotenv
     */
    protected $dotEnv;

    // ------------------------------------------------------------------------

    /**
     * Let's get PHP DotEnv setup and initialized
     *
     * @return void
     *
     * @see    \Dotenv\Dotenv::create()
     * @see    \Dotenv\Dotenv::load()
     *
     * @throws \Dotenv\Exception\InvalidFileException
     * @throws \Dotenv\Exception\InvalidPathException
     */
    public function bootDotEnv(): void
    {
        // Load the file
        $this->dotEnv = Dotenv::create(__DIR__ . '/../../');
        // Load PhpDotEnv
        $this->dotEnv->load();
    }

    // ------------------------------------------------------------------------
}
