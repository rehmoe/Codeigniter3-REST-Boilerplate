<?php

// IMPORTS --------------------------------------------------------------------
use Luthier\MiddlewareInterface;

/**
 * The JWTAuthMiddleware Class is used to ensure that the users make their
 * requests using a JWT based Authentication
 *
 * @link https://blog.restcase.com/restful-api-authentication-basics/
 * @link https://jwt.io/introduction/
 */
class JWTAuthMiddleware implements MiddlewareInterface
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
