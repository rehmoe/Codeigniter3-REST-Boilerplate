<?php

// IMPORTS --------------------------------------------------------------------
use Luthier\MiddlewareInterface;

/**
 * The DigestAuthMiddleware Class is used to ensure that the users processes
 * requests using Digest Authentication
 *
 * @link https://blog.restcase.com/restful-api-authentication-basics/
 */
class DigestAuthMiddleware implements MiddlewareInterface
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
