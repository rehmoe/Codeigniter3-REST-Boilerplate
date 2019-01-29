<?php

/**
 * The JWT Controller Class is used to demonstrate the encoding and decoding of
 * JSON Web Tokens using the built-in JWT library
 */
class JWTController extends MY_Controller
{
    /**
     * Secret Key for JSON Web Token
     *
     * @var string
     */
    private $key = 'super-secret-key';

    /**
     * A data array to encode using a JSON Web Token
     *
     * @var array $payload
     */
    private $payload = [
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
     * @see    \JWT::encode()
     *
     * @param string|null $key
     *
     * @throws DomainException
     */
    public function encode_get(string $key = null): void
    {
        $jwt = $this->jwt->encode($this->payload, $key);

        if (!$key || $key === null) {
            $this->response([
                'message' => 'Bad Request',
                'success' => false,
                'status'  => HTTP_BAD_REQUEST,
                'jwt'     => null,
            ], HTTP_BAD_REQUEST);

        } elseif ($jwt) {
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
     * @param  string $payload
     *
     * @throws DomainException
     * @throws UnexpectedValueException
     */
    public function decode_get(string $payload = null): void
    {
        $jwt = $this->jwt->decode($payload, $this->key);

        if (!$payload || $payload === null) {
            $this->response([
                'message' => 'Bad Request',
                'success' => false,
                'status'  => HTTP_BAD_REQUEST,
                'payload' => null,
            ], HTTP_BAD_REQUEST);

        } elseif ($jwt) {
            $this->response([
                'message' => 'JWT Decoded Successfully',
                'success' => true,
                'status'  => HTTP_OK,
                'payload' => $jwt,
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
