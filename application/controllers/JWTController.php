<?php

/**
 * The JWT Controller Class is used to demonstrate the encoding and decoding of
 * JSON Web Tokens using the built-in JWT library
 */
class JWTController extends MY_Controller
{
    /**
     * Secret Key for the JSON Web Token
     *
     * @var string $key
     */
    private static $key = 'super-secret-key';

    /**
     * A data array to encode and decode using the
     * $key
     *
     * @var array $payload
     */
    private static $payload = [
        'key_0' => 'value_0',
        'key_1' => 'value_1',
        'key_2' => 'value_2',
        'key_3' => 'value_3',
        'key_4' => 'value_4',
    ];

    // ------------------------------------------------------------------------

    /**
     * Encode a JSON Web Token
     *
     * @see   \JWT::encode()
     *
     * @param string|null $key
     *
     * @throws DomainException
     */
    public function encode_get(string $key = null): void
    {
        // Let's encode JWT
        $jwt = $this->jwt->encode(self::$payload, $key);

        // Build the response
        if (!$key || $key === null || !\is_string($key)) {
            $this->response([
                'message' => 'Please provide a valid key',
                'success' => false,
                'status'  => HTTP_BAD_REQUEST,
                'jwt'     => null,
            ], HTTP_BAD_REQUEST);

        } elseif (self::$key !== $key) {
            $this->response([
                'message' => 'Key Mismatch',
                'success' => true,
                'status'  => HTTP_UNAUTHORIZED,
                'jwt'     => null,
            ], HTTP_OK);

        } elseif (self::$key === $key && $jwt) {
            $this->response([
                'message' => 'JWT Encoded Successfully',
                'success' => true,
                'status'  => HTTP_OK,
                'jwt'     => $jwt,
            ], HTTP_OK);

        } else {
            $this->response([
                'message' => 'JWT Encoded Unsuccessfully',
                'success' => false,
                'status'  => HTTP_NO_CONTENT,
                'jwt'     => null,
            ], HTTP_NO_CONTENT);

        }
    }

    // ------------------------------------------------------------------------

    /**
     * Decode a JSON Web Token
     *
     * @see    \JWT::decode()
     *
     * @param  string $jwt The JSON Web Token
     *
     * @throws DomainException
     * @throws UnexpectedValueException
     */
    public function decode_get(string $jwt = null): void
    {
        // Let's encode JWT
        $payload = $this->jwt->decode($jwt, self::$key);

        // Build the response
        if (!$jwt || $jwt === null || !\is_string($jwt)) {
            $this->response([
                'message' => 'Bad Request',
                'success' => false,
                'status'  => HTTP_BAD_REQUEST,
                'payload' => null,
            ], HTTP_BAD_REQUEST);

        } elseif ($payload) {
            $this->response([
                'message' => 'JWT Decoded Successfully',
                'success' => true,
                'status'  => HTTP_OK,
                'payload' => $payload,
            ], HTTP_OK);

        } else {
            $this->response([
                'message' => 'JWT Decoded Unsuccessfully',
                'success' => false,
                'status'  => HTTP_NO_CONTENT,
                'payload' => null,
            ], HTTP_NO_CONTENT);

        }
    }

    // ------------------------------------------------------------------------
}
