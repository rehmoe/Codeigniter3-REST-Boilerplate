<?php defined('BASEPATH') || exit(HTTP_UNAUTHORIZED);

/**
 * Class MY_Controller
 */
class MY_Controller extends REST_Controller
{
    /**
     * Data array
     *
     * @var array $data
     */
    public $data;

    /**
     * CodeIgniter session library [autoloaded]
     *
     * @var \CI_Session $session
     */
    public $session;

    /**
     * Database model
     *
     * @var mixed $model
     */
    public $model;

    /**
     * The JWT library [autoloaded]
     *
     * @var \JWT $jwt
     */
    public $jwt;

    // ------------------------------------------------------------------------

    /**
     * Build application controller components upon class construction
     *
     * @param  string $config Optional REST Library config file
     */
    public function __construct(string $config = 'rest')
    {
        // REST_Controller Constructor
        parent::__construct($config);

        /*
         * Load the CLI helper in development environments and only on CLI
         * requests
         */
        if (is_cli() && ENVIRONMENT === 'development') {
            load_helper('cli');
        }

        // Check to make sure we are running on PHP >= 7.2.0
        if (PHP_VERSION < '7.2.0') {
            die('PHP Version of 7.2.0 is required. Your PHP Version is ' . PHP_VERSION);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Unset the $data array upon class destruction
     */
    public function __destruct()
    {
        parent::__destruct();

        unset($this->data);
    }

    // ------------------------------------------------------------------------
}
