<?php

/**
 * Library for a JSON Web Token implementation based on the JWT Spec
 *
 * @category Libraries
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @updated  12.04.2018
 *
 * @license  2-clause BSD
 * @version  1.0.1 [major.minor.patch]
 * @since    1.0.0 [major.minor.patch]
 *
 * @link     https://opensource.org/licenses/BSD-2-Clause
 *
 * Read about the JWT Specification Here
 * @link     https://tools.ietf.org/html/rfc7519
 */
class JWT
{
    /**
     * Decode the JSON Web Token
     *
     * @param   string      $jwt    The JWT payload
     * @param   string|null $key    The secret key
     * @param   bool        $verify Don't skip verification process
     *
     * @return  object The JWT's payload as a PHP object
     *
     * @throws \DomainException
     * @throws \UnexpectedValueException
     */
    public function decode(string $jwt, ?string $key = null, bool $verify = true)
    {
        $tks = explode('.', $jwt);
        if (count($tks) !== 3) {
            throw new UnexpectedValueException('Wrong number of segments');
        }
        [$headb64, $payloadb64, $cryptob64] = $tks;
        if (null === ($header = $this->jsonDecode($this->urlsafeB64Decode($headb64)))) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        if (null === $payload = $this->jsonDecode($this->urlsafeB64Decode($payloadb64))) {
            throw new UnexpectedValueException('Invalid segment encoding');
        }
        $sig = $this->urlsafeB64Decode($cryptob64);
        if ($verify) {
            if (empty($header->alg)) {
                throw new DomainException('Empty algorithm');
            }
            if ($sig !== $this->sign("$headb64.$payloadb64", $key, $header->alg)) {
                throw new UnexpectedValueException('Signature verification failed');
            }
        }

        return $payload;
    }

    // ------------------------------------------------------------------------

    /**
     * Encode the JSON Web Token
     *
     * @param  object|array $payload PHP object or array
     * @param  string       $key     The secret key
     * @param  string       $algo    The signing algorithm
     *
     * @return string A JWT
     *
     * @throws \DomainException
     */
    public function encode($payload, string $key, string $algo = 'HS256'): string
    {
        $header        = ['typ' => 'JWT', 'alg' => $algo];
        $segments      = [];
        $segments[]    = $this->urlsafeB64Encode($this->jsonEncode($header));
        $segments[]    = $this->urlsafeB64Encode($this->jsonEncode($payload));
        $signing_input = implode('.', $segments);
        $signature     = $this->sign($signing_input, $key, $algo);
        $segments[]    = $this->urlsafeB64Encode($signature);

        return implode('.', $segments);
    }

    // ------------------------------------------------------------------------

    /**
     * Return an encrypted message
     *
     * @param  string $msg    The message to sign
     * @param  string $key    The secret key
     * @param  string $method The signing algorithm
     *
     * @return string An encrypted message
     *
     * @throws \DomainException
     */
    public function sign(string $msg, string $key, string $method = 'HS256'): string
    {
        $methods = [
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        ];
        if (empty($methods[$method])) {
            throw new DomainException('Algorithm not supported');
        }

        return hash_hmac($methods[$method], $msg, $key, true);
    }

    // ------------------------------------------------------------------------

    /**
     * Decode the JSON data
     *
     * @param  string $input JSON string
     *
     * @return object Object representation of JSON string
     *
     * @throws \DomainException
     */
    public function jsonDecode(string $input)
    {
        $obj = \json_decode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            $this->handleJsonError($errno);

        } elseif ($obj === null && $input !== 'null') {
            throw new DomainException('Null result with non-null input');
        }

        return $obj;
    }

    // ------------------------------------------------------------------------

    /**
     * Encode the JSON data
     *
     * @param  object|array $input A PHP object or array
     *
     * @return string JSON representation of the PHP object or array
     *
     * @throws \DomainException
     */
    public function jsonEncode($input): string
    {
        $json = \json_encode($input);
        if (function_exists('json_last_error') && $errno = json_last_error()) {
            $this->handleJsonError($errno);

        } elseif ($json === 'null' && $input !== null) {
            throw new DomainException('Null result with non-null input');
        }

        return $json;
    }

    // ------------------------------------------------------------------------

    /**
     * URL Safe Decoding
     *
     * @param  string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public function urlsafeB64Decode(string $input): string
    {
        $remainder  = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }

        return base64_decode(strtr($input, '-_', '+/'));
    }

    // ------------------------------------------------------------------------

    /**
     * URL Safe Encoding
     *
     * @param  string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public function urlsafeB64Encode(string $input): string
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    // ------------------------------------------------------------------------

    /**
     * JSON Error Handler
     *
     * @param  int $errno An error number from \json_last_error()
     *
     * @see    \json_last_error()
     *
     * @link   http://php.net/manual/en/function.json-last-error.php
     *
     * @return void
     *
     * @throws \DomainException
     */
    public function handleJsonError(int $errno): void
    {
        $messages = [
            JSON_ERROR_DEPTH     => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX    => 'Syntax error, malformed JSON',
        ];
        throw new DomainException($messages[$errno] ?? 'Unknown JSON error: ' . $errno);
    }

    // ------------------------------------------------------------------------
}
