<?php

// IMPORTS --------------------------------------------------------------------
use Luthier\MiddlewareInterface;

/**
 * The BasicAuthMiddleware Class is used to ensure that the users processes
 * requests using Basic Authentication
 *
 * @link https://blog.restcase.com/restful-api-authentication-basics/
 */
class BasicAuthMiddleware implements MiddlewareInterface
{

    /**
     * Middleware entry point
     *
     * @param mixed $args Middleware arguments
     *
     * @return mixed
     */
    public function run($args)
    {
        // TODO: Implement run() method.
    }
}
