<?php
/**
 * This is a set of useful helper functions that can be used application wide and
 * includes access to functions for working with the command line interface.
 *
 * @package  Helpers
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @updated  01.08.2019
 *
 * @license  MIT License
 *
 * @link     https://www.codeigniter.com/userguide3/general/helpers.html
 * @link     https://opensource.org/licenses/MIT
 */

// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('pl_string')) {
/**
 * Print human-readable string line
 *
 * @param $input
 */
    function pl_string(string $input)
    {
        echo $input . PHP_EOL;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('pl_array')) {
    /**
     * Print human-readable array line
     *
     * @param array $input
     */
    function pl_array(array $input)
    {
        if (!empty($input) && is_array($input)) {
            foreach ($input as $key => $value) {
                pl_string("[" . $key . "] => " . $value);
            }
        }
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('pl_br')) {
    /**
     * Print humean-readable line break
     *
     * @param int $length
     *
     * @return string
     */
    function pl_br(int $length = 40)
    {
        $output = '';
        for ($i = 0; $i < $length; $i++) {
            $output .= '-';
        }
        return $output;
    }
}
// ----------------------------------------------------------------------------
