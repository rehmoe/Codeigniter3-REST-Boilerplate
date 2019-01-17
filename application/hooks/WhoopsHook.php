<?php defined('BASEPATH') || exit('Access Denied');

// IMPORT DEPENDENCIES --------------------------------------------------------
use Whoops\{
    Handler\JsonResponseHandler,
    Handler\PrettyPageHandler,
    Util\Misc,
    Run
};

/**
 * WhoopsHook is a class used to instantiate Whoops Error/Exception handling
 * in a Codeigniter 3 application!
 *
 * @package  Hooks
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @license  MIT License
 */
class WhoopsHook
{
    /**
     * Tell JsonResponseHandler to give a stack trace?
     *
     * @var bool $addTraceToOutput
     */
    protected $addTraceToOutput = false;

    /**
     * Return a result compliant to the json:api spec?
     *
     * @var  bool $setJsonApi
     *
     * @link http://jsonapi.org/examples/#error-objects
     */
    protected $setJsonApi = true;

    // ------------------------------------------------------------------------

    /**
     * Let's boot Whoops up!
     *
     * @see    \Whoops\Run::pushHandler()
     * @see    \Whoops\Handler\JsonResponseHandler
     * @see    \Whoops\Handler\PrettyPageHandler
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public function bootWhoops(): void
    {
        // Create a new Whoops object
        $whoops = new Run;

        // If we are performing an AJAX request...
        if (Misc::isAjaxRequest()) {

            // Create a new JsonResponseHandler object
            $jsonHandler = new JsonResponseHandler();

            // Tell JsonResponseHandler to give a stack trace
            $jsonHandler->addTraceToOutput($this->addTraceToOutput);

            // Return a result compliant to the json:api spec
            $jsonHandler->setJsonApi($this->setJsonApi);

            // Now, we push it into the stack:
            $whoops->pushHandler($jsonHandler);

        // ... Otherwise, we'll want the error page to be shown by default
        } else {
            $whoops->pushHandler(new PrettyPageHandler());
        }

        // And away we go!
        $whoops->register();
    }

    // ------------------------------------------------------------------------
}
