<?php

// IMPORT DEPENDENCIES --------------------------------------------------------
use Exceptions\IO\Filesystem\{
    FileNotReadableException,
    FileNotWritableException,
    FileNotFoundException
};

/**
 * This is a set of useful helper functions that can be used application wide and
 * help with array recursion, getting the global CI_Controller instance, allowing
 * for directory traversal & procedural functions that access the CI_Loader class
 * which assist in loading views, helpers, packages, drivers, models, libraries &
 * more.
 *
 * It also includes access to functions for getting/setting environment variables
 * & takes advantage of a library of more enhanced Exceptions that live inside of
 * the \Exceptions namespace.
 *
 * NOTE: Make sure to run composer install and install the simple dependancies for
 * this helper
 *
 * @package  Helpers
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @updated  01.15.2019
 *
 * @license  MIT License
 *
 * @see      FileNotReadableException
 * @see      FileNotWritableException
 * @see      FileNotFoundException
 *
 * @link     https://www.codeigniter.com/userguide3/general/helpers.html
 * @link     https://github.com/crazycodr/standard-exceptions
 * @link     https://opensource.org/licenses/MIT
 */

/** ---------------------------------------------------------------------------
 * GAINING ACCESS TO THE CODEIGNITER SINGLETON INSTANCE SO WE CAN CALL IT IN
 * ANY PART OF THE APPLICATION WE NEED TO.
 * ------------------------------------------------------------------------- */
// When/If the function does not exist, let's create it!
if (!function_exists('ci')) {
    /**
     * A simple syntactic sugar function. This will return the CodeIgniter CI_Controller.
     * No more using the $CI = &get_instance calls. Simply just use ci()->input->post(..),
     * ci()->output->set_header(..), etc
     *
     * @return \CI_Controller
     */
    function ci()
    {
        // Assign get_instance() and return it
        $ci =& get_instance();

        return $ci;
    }
}
/** ---------------------------------------------------------------------------
 * CODEIGNITER HELPER FUNCTIONS FOR MAKING VIEW CALLS, MODELS CALLS AND MORE
 * ------------------------------------------------------------------------- */
// When/If the function does not exist, let's create it!
if (!function_exists('load_model')) {
    /**
     * Loads and instantiates models.
     *
     * USAGE: load_model('model_name', 'model_alias', false/true)
     *
     * @param  mixed  $model   The name of the model you would like to load
     * @param  string $alias   An optional object name to assign the model
     * @param  string $db_conn Dabtase active group [default: 'default']
     *
     * @throws RuntimeException
     */
    function load_model($model, string $alias = null, string $db_conn = null)
    {
        ci()->load->model($model, $alias ?? '', $db_conn ?? 'default');
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_library')) {
    /**
     * Loads and instantiates libraries. Designed to be called from application controllers.
     *
     * USAGE: load_library('library_name', ['param_array'], 'object_name')
     *
     * @param mixed  $library     Library file name [in lowercase format]
     * @param array  $params      Optional parameters for the constructor
     * @param string $object_name An optional object name to assign to it
     */
    function load_library($library, array $params = null, string $object_name = null)
    {
        ci()->load->library($library, $params, $object_name);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_view')) {
    /**
     * View loader function loads "view" files.
     *
     * USAGE: load_view('view_name', ['data_array'], false/true)
     *
     * @param  string $view   View name
     * @param  array  $vars   An associative array of data to be extracted for use in the view
     * @param  bool   $return Whether to return the view output or leave it to the Output class
     */
    function load_view($view, array $vars = [], $return = false)
    {
        ci()->load->view($view, $vars, $return);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_helper')) {
    /**
     * Helper Loader
     *
     * USAGE: load_helper('helper_name') // without the `_helper.php` suffix
     *
     * @param string|string[] $helpers Helper name(s) [string[..] or string]
     */
    function load_helper($helpers)
    {
        ci()->load->helper($helpers);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_package')) {
    /**
     * Third party package loader loads from the APPPATH/third_party directory
     *
     * USAGE: load_package('package_name', true/false)
     *
     * @param  string $path         Path to add
     * @param  bool   $view_cascade (default: TRUE)
     */
    function load_package(string $path = '', bool $view_cascade = true)
    {
        ci()->load->add_package_path($path, $view_cascade);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('remove_package')) {
    /**
     * Third party package loader removes packages from the APPPATH/third_party
     * directory
     *
     * USAGE: remove_package('package_name')
     *
     * @param  string $path Path to remove
     */
    function remove_package(string $path = '')
    {
        ci()->load->remove_package_path($path);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_driver')) {
    /**
     * Loads a driver library.
     *
     * USAGE: load_driver('driver_name', ['params_array'], 'object_name')
     *
     * @param string|string[] $library     Driver name(s)
     * @param array           $params      Optional parameters to pass to the driver
     * @param string          $object_name An optional object name to assign to
     */
    function load_driver($library, array $params = null, string $object_name = null)
    {
        ci()->load->driver($library, $params, $object_name);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_config')) {
    /**
     * Loads a config file (an alias for CI_Config::load()).
     *
     * @param string $file            Configuration file name
     * @param bool   $use_sections    Whether configuration values should be loaded into their own section
     * @param bool   $fail_gracefully Whether to just return FALSE or display an error message
     */
    function load_config($file, $use_sections = false, $fail_gracefully = false)
    {
        ci()->load->config($file, $use_sections, $fail_gracefully);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_loaded')) {
    /**
     * A utility method to test if a class is in the \CI_Loader::$_ci_classes array.
     *
     * USAGE: is_loaded('class_name')
     *
     * @see   \CI_Loader::$_ci_classes array
     *
     * @param string $class Class name to check for
     */
    function is_loaded(string $class)
    {
        ci()->load->is_loaded($class);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_countable')) {
    /**
     * A polyfill for PHP 7.3's `is_countable()` functionality
     *
     * @param mixed $var
     *
     * @link  http://php.net/manual/en/function.is-countable.php
     *
     * @return bool
     */
    function is_countable($var): bool
    {
        return (is_array($var) || $var instanceof Countable);
    }
}
/** ---------------------------------------------------------------------------
 * SOME BASIC HELPER FUNCTIONS FOR LOADING ASSETS AND RESOURCES
 * ------------------------------------------------------------------------- */
// When/If the function does not exist, let's create it!
if (!function_exists('assets_url')) {
    /**
     * Load the resources/assets URI via the resource_dir config item.
     * Default: FCPATH/assets/
     *
     * USAGE:
     *  -> Default Assets Directory:   assets_url('css/stylesheet.css');
     *       -> Implies this file lives at FCPATH/assets/css/stylesheet.css
     *  -> Different Assets Directory: assets_url('css/stylesheet.css', 'static');
     *       -> Implies this file lives at FCPATH/static/css/stylesheet.css
     *
     * @param  string $file The subdirectory from where to load your assets
     * @param  string $path Change if different from FCPATH/assets/
     *
     * @return string
     *
     */
    function assets_url(string $file = '', string $path = 'assets'): string
    {
        // Return the Config Value
        return base_url($path . _DS_ . $file);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_css')) {
    /**
     * Method to load css files into your project relative to the resources URI
     *
     * @param  string|array $stylesheets The stylesheet file(s) to load
     * @param  string       $alt_path
     * @param  string       $alt_ext
     *
     * @return string
     */
    function load_css($stylesheets, string $alt_path = 'css/', string $alt_ext = '.css'): string
    {
        // If we are !not passing an array of stylesheets
        if (!is_array($stylesheets)) {
            // Cast the $stylesheets variable to an array
            $stylesheets = (array)$stylesheets;
        }
        // Initially setup $return as an empty string
        $return = '';
        // Foreach $stylesheets passed
        foreach ($stylesheets as $stylesheet) {
            // Assign the return
            $return .= '<link rel="stylesheet" href="' .
                assets_url($alt_path . _DS_ . $stylesheet . $alt_ext) . '"/>' . "\n";
        }

        // Return the $return value
        return $return;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('load_js')) {
    /**
     * Method to load javascript files into your project relative to the resources URI
     *
     * @param  string|array $javascripts The javascript file(s) to load
     * @param  string       $alt_path
     * @param  string       $alt_ext
     *
     * @see    \assets_url()
     *
     * @return string
     *
     */
    function load_js($javascripts, string $alt_path = 'js/', string $alt_ext = '.js'): string
    {
        // If we are !not passing an array of javascripts
        if (!is_array($javascripts)) {
            // Cast the $javascripts variable to an array
            $javascripts = (array)$javascripts;
        }
        // Initially setup $return as an empty string
        $return = '';
        // Foreach $javascripts passed
        foreach ($javascripts as $javascript) {
            // Assign the return
            $return .= '<script type="text/javascript" src="' .
                assets_url($alt_path . $javascript . $alt_ext) . '"></script>' . "\n";
        }

        // Return the $return value
        return $return;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('active_link')) {
    /**
     * This function will detect if the current controller matches your URI
     * and assign an 'active' class if placed in a link, nav item, or other
     * areas that require style changes based off of an 'active' status
     *
     * @param  string $controller The controller to test against
     * @param  string $method     The method to test against
     *
     * @return string
     */
    function active_link(string $controller, string $method = 'index'): string
    {
        // Getting Router Class for Activation of Class and Method (Optional)
        $class = ci()->router->class;
        $function = ci()->router->method;

        // Return the active status if the class/method equals the controller/method names
        return ($class === $controller && $function === $method) ? 'active': '';
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_selected')) {
    /**
     * Assign a `selected` attribute to an HTML tag
     *
     * @param $data1
     * @param $data2
     */
    function is_selected($data1, $data2)
    {
        if ($data1 === $data2) {
            echo 'selected="selected"';
        } else {
            echo '';
        }
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_checked')) {
    /**
     * Assign a `checked` attribute to an HTML tag
     *
     * @param        $data1
     * @param        $data2
     * @param string $multi
     */
    function is_checked($data1, $data2, $multi = '')
    {
        if (!empty($multi)) {
            if (in_array($data1, $data2, true)) {
                echo 'checked="checked"';
            } else {
                echo '';
            }
        } else {
            if ($data1 === $data2) {
                echo 'checked="checked"';
            } else {
                echo '';
            }
        }
    }
}
/** ---------------------------------------------------------------------------
 * SOME BASIC HELPER FUNCTIONS FOR LOADING AND SETTING ENVIRONMENTAL VARIABLES
 * ------------------------------------------------------------------------- */
if (!function_exists('env')) {
    /**
     * Syntactic sugar for the getenv(...) function and the $_ENV[...] array
     *
     * @param string $varname    The variable name as the key in the env file [optional]
     * @param string $env_path   The default .env file path [default: FCPATH]
     * @param string $file       The env file you'd like to load if different from `.env`
     * @param bool   $local_only Set to true to only return local environment variables [optional]
     *
     * @see    DotEnv::load()
     *
     * @throws FileNotFoundException
     */
    function env(string $varname = null, string $env_path = FCPATH, string $file = '.env', bool $local_only = false)
    {
        if (file_exists($env_path . $file)) {
            // Get the env configuration setting
            env($varname, $local_only);
        } else {
            $error_message = 'ERROR ' . HTTP_NOT_FOUND . ': The .env file could not be located.';
            log_message('ERROR', $error_message);
            throw new FileNotFoundException($error_message);
        }
    }
}
// ----------------------------------------------------------------------------
if (!function_exists('set_env')) {
    /**
     * Set .env values based off of their keys
     *
     * @param array  $data     The  an associative array of the keys => values to alter
     * @param string $env_path The default .env file path [default: FCPATH]
     * @param string $file     The env file you'd like to load if different from `.env`
     *
     * @return bool
     *
     * USAGE:
     *  // Build an associative array for the .env values we'd like to change/set
     *  $env_values = [
     *    'ENV_KEY_ONE' => NEW_VALUE_ONE',
     *    'ENV_KEY_TWO' => NEW_VALUE_TWO',
     *    'ENV_KEY_ETC' => NEW_VALUE_ETC',
     *  ];
     *  // Set the .env values using set_env(...)
     *  set_env($env_values);
     */
    function set_env(array $data = [], string $file = '.env', string $env_path = FCPATH): bool
    {
        if (count($data) > 0) {
            // Read .env-file
            $env = file_get_contents($env_path . $file . '.' . ENVIRONMENT);
            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);
            // Loop through given data
            foreach ($data as $key => $value) {
                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {
                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode('=', $env_value, 2);
                    // Check, if new key fits the actual .env-key
                    if ($entry[0] === $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . '=' . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }
            // Turn the array back to an String
            $env = implode("\n", $env);
            // And overwrite the .env with the new data
            file_put_contents($env_path . $file . '.' . ENVIRONMENT, $env);

            return true;
        } else {
            return false;
        }
    }
}
/** ---------------------------------------------------------------------------
 * BASIC HELPER FUNCTIONS FOR LOGGING AND DISPLAYING MESSAGES AND/OR ERRORS
 * ------------------------------------------------------------------------- */
if (!function_exists('show_and_log_error')) {
    /**
     * Show an on-screen message and log the details to the log
     *
     * @param  string $message     The error message for logging and for show_error()
     * @param  int    $status_code The HTTP Status Code for show_error() [default: 500]
     * @param  string $log_level   The error level: 'ERROR', 'DEBUG' or 'INFO'
     * @param  string $heading     The heading of the show_error() function
     *
     * @throws RuntimeException
     */
    function show_and_log_error(
        string $message,
        int $status_code = HTTP_INTERNAL_SERVER_ERROR,
        string $log_level = 'INFO',
        string $heading = 'An Error Was Encountered'
    ) {
        show_error($message, $status_code, $heading);
        config_item('log_path') !== null ? log_message($log_level, $message): false;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('log_and_exit')) {
    /**
     * Log a system message and exit a script
     *
     * @param string $message     The message to display and log to the system
     * @param int    $status_code The HTTP Status Code for the exit() function
     * @param string $log_level   Error level: ERROR|DEBUG|INFO [Default: INFO]
     */
    function log_and_exit(
        string $message = 'Access Denied',
        int $status_code = HTTP_FORBIDDEN,
        string $log_level = 'INFO'
    ) {
        // Exit with the custom message and status code
        log_message($log_level, $message);
        json_encode([
            'message' => $message,
            'status'  => $status_code ?? HTTP_FORBIDDEN,
        ]);
        exit($status_code);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('log_and_throw')) {
    /**
     * Log a system message and throw an exception.
     *
     * @param string $message     The message to display and log to the system
     * @param string $exception   The PHP exception to throw to the end user [ Default: \Exception]
     * @param int    $status_code The HTTP Status Code for the exit() function
     * @param string $log_level   Error level: ERROR|DEBUG|INFO [Default: INFO]
     */
    function log_and_throw(
        string $message,
        string $exception = \Exception::class,
        int $status_code = HTTP_FORBIDDEN,
        string $log_level = 'INFO'
    ) {
        // Exit with the custom message and status code
        log_message($log_level, $message);
        throw new $exception($message ? : $exception . ' Thrown with code ' . $status_code);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('show_json_error')) {
    /**
     * Return JSON errors messages to AJAX calls instead of standard HTML error
     * page
     *
     * @param        $message
     * @param int    $status_code
     * @param string $status_message
     */
    function show_json_error($message, int $status_code = 500, string $status_message = '')
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        set_status_header($status_code, $status_message);
        echo json_encode(
            [
                'status'  => false,
                'error'   => 'Server Error',
                'message' => $message,
            ]
        );
        exit;
    }
}
/** ---------------------------------------------------------------------------
 * OTHER HELPER FUNCTIONS ...
 * ------------------------------------------------------------------------- */
// When/If the function does not exist, let's create it!
if (!function_exists('is_controller')) {
    /**
     * Checks URI against a controllers route
     *
     * @param  string $controller The controller class
     * @param  string $method     The controller method
     *
     * @return bool
     *//*
     *
     * USAGE:
     * if(is_controller('controller_name') { ?>
     *
     *     <span>Show me if `controller_name` matches my current controllers URI!</span>
     *
     * <?php }; ?>
     */
    function is_controller(string $controller, string $method = 'index'): bool
    {
        // Getting Router Class for Activation of Class and Method (Method is Optional)
        $class = ci()->router->class;
        $function = ci()->router->method;

        // RETURN the $controller as verified or return NULL
        return $class === $controller && $function === $method;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('string_to_int')) {
    /**
     * Convert a string to an integer in a simple way
     *
     * @param  string $string
     *
     * @return int
     */
    function string_to_int(string $string): int
    {
        // Return the integer value of the string
        return (int)$string;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('string_to_float')) {
    /**
     * Convert a string to a float in a simple way. More verbose functionality is
     * below in the form of the convert_to_float(...) function
     *
     * @param  string $string
     *
     * @return float
     */
    function string_to_float(string $string): float
    {
        // Return the float value of the string
        return (float)$string;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('convert_to_float')) {
    /**
     * This function takes the last comma or dot (if any) to make a clean float,
     * ignoring thousand separator, currency or any other letter
     *
     * @link   http://php.net/manual/en/function.float.php
     *
     * @param  int $integer
     *
     * @return float
     */
    function convert_to_float(int $integer): float
    {
        $dotPos = strrpos($integer, '.');
        $commaPos = strrpos($integer, ',');
        if (($commaPos > $dotPos) && $commaPos) {
            $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos: $commaPos;
        } else {
            $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos: false;
        }
        if (!$sep) {
            return (float)
            preg_replace('/[\D]/', '', $integer);
        }

        return (float)
            preg_replace('/[\D]/', '', substr($integer, 0, $sep)) . '.' .
            preg_replace('/[\D]/', '', substr($integer, $sep + 1, strlen($integer)));
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('convert_to_int')) {
    /**
     * Convert to an integer in a simple way.
     *
     * @param $val
     *
     * @return int
     */
    function convert_to_int($val): int
    {
        return (int)$val;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('generate_uri_hash')) {
    /**
     * Generate a URI Hash
     *
     * @param  int $start
     * @param  int $finish
     *
     * @return string
     *
     * @throws Exception
     */
    function generate_uri_hash(int $start = 01, int $finish = 32): string
    {
        return md5(random_int($start, $finish) . microtime());
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('str_split_unicode')) {
    /**
     * A proper unicode string split
     *
     * Usage: str_split_unicode($string_val, 3);
     *
     * @param string $str
     * @param int    $length
     *
     * @return array
     */
    function str_split_unicode(string $str, int $length = 1): array
    {
        $tmp = preg_split('~~u', $str, -1, PREG_SPLIT_NO_EMPTY);
        if ($length > 1) {
            $chunks = array_chunk($tmp, $length);
            foreach ($chunks as $i => $chunk) {
                $chunks[$i] = implode('', (array)$chunk);
            }
            $tmp = $chunks;
        }

        return $tmp;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('echo_limit')) {
    /**
     * Echo out a custom string and define its maximum character length...
     *
     * @param string $string The string to echo / output to the screen
     * @param int    $length The amount of characters to echo from the string
     */
    function echo_limit(string $string, int $length = 160)
    {
        if (strlen($string) <= $length) {
            echo $string;
        } else {
            $y = substr($string, 0, $length) . '...';
            echo $y;
        }
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('merge_paths')) {
    /**
     * @param $path1
     * @param $path2
     *
     * @return string
     */
    function merge_paths(string $path1, string $path2): string
    {
        $path1 = str_replace('\\', '/', $path1);
        $path2 = str_replace('\\', '/', $path2);
        //
        $p1 = explode('/', trim($path1, ' /'));
        $p2 = explode('/', trim($path2, ' /'));
        $len = count($p1);
        do {
            if (array_slice($p1, -$len) === array_slice($p2, 0, $len)) {
                return '/'
                    . implode('/', array_slice($p1, 0, -$len))
                    . '/'
                    . implode('/', $p2);
            }
        } while (--$len);

        return '/' . implode('/', array_merge($p1, $p2));
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('real_path')) {
    /**
     * real_path(...) is like working with absolute/relative paths only a little
     * bit shorter =D
     *
     * @param $path
     *
     * @return string
     */
    function real_path(string $path): string
    {
        $path = str_replace('\\', '/', $path);
        $out = [];
        foreach (explode('/', $path) as $i => $fold) {
            if ($fold === '' || $fold === '.') {
                continue;
            }
            if ($fold === '..' && $i > 0 && end($out) !== '..') {
                array_pop($out);
            } else {
                $out[] = $fold;
            }
        }

        return ($path{0} === '/' ? '/': '') . implode('/', $out);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('number_format_short')) {
    /**
     * A short number formatter
     *
     * @param      $n
     * @param  int $precision
     *
     * @return string
     */
    function number_format_short($n, int $precision = 1): string
    {
        if ($n < 900) {
            // 0 - 900
            $n_format = number_format($n, $precision);
            $suffix = '';
        } else {
            if ($n < 900000) {
                // 0.9k-850k
                $n_format = number_format($n / 1000, $precision);
                $suffix = 'K';
            } else {
                if ($n < 900000000) {
                    // 0.9m-850m
                    $n_format = number_format($n / 1000000, $precision);
                    $suffix = 'M';
                } else {
                    if ($n < 900000000000) {
                        // 0.9b-850b
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        // 0.9t+
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }
                }
            }
        }
        if ($precision > 0) {
            $dotzero = '.' . str_repeat('0', $precision);
            $n_format = str_replace($dotzero, '', $n_format);
        }

        return $n_format . $suffix;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('readCSV')) {
    /**
     * Read from a CSV file
     *
     * @param $csvFile
     *
     * @return array
     */
    function readCSV(string $csvFile): array
    {
        $file_handle = fopen($csvFile, 'rb');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);

        return $line_of_text;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('list_files')) {
    /**
     * List files in a directory
     *
     * @param string $dir            The directory to traverse and show
     * @param string $hrefTarget     HTML Hyperlink Reference Locations
     * @param string $additionalHtml Additional HTML (ID, Classes, Etc)
     */
    function list_files(string $dir, string $hrefTarget = '_parent', string $additionalHtml = null)
    {
        if (is_dir($dir) && $handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file !== '.' && $file !== '..' && $file !== 'Thumbs.db') {
                    echo '<a target="' . $hrefTarget . '" href="' . $dir . $file . '"' . ' ' .
                        $additionalHtml . '>' . $file . '</a><br>' . "\n";
                }
            }
            closedir($handle);
        }
    }
}

// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('delete_dir')) {
    /**
     * Delete a directory
     *
     * @param  $path
     *
     * @return bool
     *
     * @throws FileNotFoundException
     */
    function delete_dir(string $path): bool
    {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path, SCANDIR_SORT_NONE), ['.', '..']);
            foreach ($files as $file) {
                delete_dir(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        }
        if (is_file($path) === true) {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                throw new FileNotFoundException("The file: {$file} cannot be found.");
            }
        }

        return false;
    }
}

// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('set_thumbnail')) {
    /**
     * Generate a thumbnail image
     *
     * @param  mixed $src
     * @param  int   $width
     * @param  int   $height
     *
     * @see    \get_thumbnail()
     *
     * @throws RuntimeException
     */
    function set_thumbnail($src, int $width = 60, int $height = 60)
    {
        // Get src file's dirname, filename and extension
        $path = pathinfo($src);

        // Path to image thumbnail
        $saveDirec = 'thumbnails' . _DS_ . $width . 'x' . $height . _DS_;
        $new_thumb = $saveDirec . $path['filename'] . "." . $path['extension'];

        // Check if already file exists
        if (!file_exists($new_thumb)) {
            // if Directory not exsits then create it.
            if (!is_dir($saveDirec)) {
                if (!mkdir($saveDirec, 0777, true) && !is_dir($saveDirec)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $saveDirec));
                }
            }

            // Load the image library which will be used by the codeigniter for image processing
            $config['image_library'] = 'gd2';

            // Setting up the source of image
            $config['source_image'] = $src;

            // Get the all attributes of original image
            [$original_width, $original_height, $file_type, $attr] = getimagesize($config['source_image']);

            // This path for the new image otherwise overwrite the original image.
            $config['new_image'] = $saveDirec;

            // Division of original image width by required width
            $widthRatio = ($original_width / $width);

            // Division of original image height by required height
            $heightRatio = ($original_height / $height);

            // Then compare which one is lesser
            if ($widthRatio < $heightRatio) {
                $multiplyRatio = $widthRatio;

            } else {
                $multiplyRatio = $heightRatio;
            }
            // Multiply the lesser value with the required both width and height
            $widthFinal = $width * $multiplyRatio;
            $heightFinal = $height * $multiplyRatio;
            $config['width'] = floor($widthFinal);
            $config['height'] = floor($heightFinal);
            $config['maintain_ratio'] = false;

            // set our cropping limits according to the center of image.
            $x_axis = ($original_width / 2) - ($widthFinal / 2);
            $y_axis = ($original_height / 2) - ($heightFinal / 2);

            // $x_axis = ($original_width - $width) / 2;
            // $y_axis = ($original_height - $height) / 2;
            $config['x_axis'] = $x_axis;
            $config['y_axis'] = $y_axis;
            ci()->load->library('image_lib');
            ci()->image_lib->initialize($config);
            if (!ci()->image_lib->crop()) {
                echo ci()->image_lib->display_errors();
                die();

            }
            ci()->image_lib->clear();

            // again get the image for the next process of resizing
            $config['source_image'] = $new_thumb;
            $config['new_image'] = $saveDirec;
            $config['width'] = $width;
            $config['height'] = $height;
            $config['maintain_ratio'] = true;

            // $config['y_axis'] = 50;
            ci()->load->library('image_lib');
            ci()->image_lib->initialize($config);

            if (!ci()->image_lib->resize()) {
                echo ci()->image_lib->display_errors();
                die();

            }

            ci()->image_lib->clear();
        }
    }
}

// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_thumbnail')) {

    /**
     * Return a generated thumbnail
     *
     * @param mixed $src
     * @param int   $width
     * @param int   $height
     *
     * @return string
     *
     * @see   \set_thumbnail()
     */
    function get_thumbnail($src, int $width = 60, int $height = 60): string
    {
        $dir = 'thumbnails' . _DS_ . $width . 'x' . $height . _DS_;

        return assets_url($dir . $src);
    }
}

// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('qr_code')) {
    /**
     * Generate a QR Code
     *
     * @param         $data
     * @param  string $type
     * @param  string $size
     * @param  string $ec
     * @param  string $margin
     *
     * @return mixed
     */
    function qr_code($data, string $type = 'TXT', string $size = '150', string $ec = 'L', string $margin = '0')
    {
        $types = [
            'URL'   => 'http://',
            'TEL'   => 'TEL:',
            'TXT'   => '',
            'EMAIL' => 'MAILTO:',
        ];
        if (!in_array($type, ['URL', 'TEL', 'TXT', 'EMAIL'], true)) {
            $type = 'TXT';
        }
        if (!preg_match('/^' . $types[$type] . '/', $data)) {
            $data = str_replace("\\", '', $types[$type]) . $data;
        }
        $ch = curl_init();
        $data = urlencode($data);
        curl_setopt($ch, CURLOPT_URL, 'http://chart.apis.google.com/chart');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            'chs=' . $size . 'x' . $size . '&cht=qr&chld=' . $ec . '|' . $margin . '&chl=' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('strstr_after')) {
    /**
     * A customized PHP strstr() function that checks after the $haystack
     *
     * @param       $haystack
     * @param       $needle
     * @param  bool $case_insensitive
     *
     * @link   http://php.net/manual/en/function.strstr.php
     *
     * @return bool|string
     */
    function strstr_after($haystack, $needle, bool $case_insensitive = false)
    {
        $strpos = $case_insensitive ? 'stripos': 'strpos';
        $pos = $strpos($haystack, $needle);
        if (is_int($pos)) {
            return substr($haystack, $pos + strlen($needle));
        }

        // Most likely false or null
        return $pos;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('contains_substr')) {
    /**
     * @link   https://secure.php.net/manual/en/function.substr-compare.php
     *
     * @param       $mainStr
     * @param       $str
     * @param  bool $loc
     *
     * @return bool
     */
    function contains_substr(string $mainStr, string $str, bool $loc = false): bool
    {
        if ($loc === false) {
            return (strpos($mainStr, $str) !== false);
        }
        if (strlen($mainStr) < strlen($str)) {
            return false;
        }
        if (($loc + strlen($str)) > strlen($mainStr)) {
            return false;
        }

        return (strcmp(substr($mainStr, $loc, strlen($str)), $str) === 0);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('trim_array')) {
    /**
     * Recursively trim an array
     *
     * @param  array|string $input
     *
     * @return array|string
     */
    function trim_array($input)
    {
        if (!is_array($input)) {
            return trim($input);
        }

        return array_map('trim_array', $input);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('recursive_mda')) {
    /**
     * Loop through multi-dimensional arrays with ease
     *
     * @param  array $array array The multi-dimensional array
     * @param  int   $level The nest level of the array
     *
     * @return null
     */
    function recursive_mda(array $array, int $level = 1)
    {
        foreach ($array as $key => $value) {
            // If $value is an array.
            if (is_array($value)) {
                // We need to loop through it.
                recursive_mda($value, $level + 1);
            } else {
                // It is not an array, so print it out.
                echo str_repeat('-', $level), $value, '<br>';
            }
        }

        return null;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('strpos_array')) {
    /**
     * Find strings position in an array
     *
     * @param  string $haystack
     * @param  array  $needles
     *
     * @return bool|int
     */
    function strpos_array(string $haystack, array $needles)
    {
        if (is_array($needles)) {
            foreach ($needles as $str) {
                if (is_array($str)) {
                    $pos = strpos_array($haystack, $str);
                } else {
                    $pos = strpos($haystack, $str);
                }
                if ($pos !== false) {
                    return $pos;
                }
            }
        } else {
            return strpos($haystack, $needles);
        }
        $needles = false;

        return $needles;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('array_pluck')) {
    /**
     * Grabs all of the elements of that key from an array of arrays
     *
     * @param  string $needle
     * @param  array  $arr
     *
     * @return array
     */
    function array_pluck(string $needle, array $arr): array
    {
        $output = [];
        foreach ($arr as $key => $value) {
            if (array_key_exists($needle, $value)) {
                $output[] = $value[$needle];
            }
        }

        return $output;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('array_print')) {
    /**
     * Prints the array in HTML, to assist with debugging
     *
     * @param      $data
     * @param bool $return
     *
     * @return mixed|string
     */
    function array_print(array $data, bool $return = false)
    {
        $output = print_r($data, true);
        $output = htmlentities($output);
        $output = str_replace(" ", "&nbsp;", $output);
        $output = nl2br($output);
        $output = "<div style='background-color:#FFFFFF;'>" . $output . "</div>";

        if (!$return) {
            echo $output;
        }

        return $output;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('array_flatten')) {
    /**
     * Pulls all of the elements of each sub array up a level, repeated recursively for
     * $level times
     *
     * @param array $data
     * @param int level
     *
     * @return array
     *
     * EXAMPLE:
     *  $arr = array(1,2,3,array(4,5,6));
     *  array_flatten($arr); // returns array(1,2,3,4,5,6);
     */
    function array_flatten(array $data, int $level = 1): array
    {
        if (!$level) {
            return $data;
        }

        $output = [];
        foreach ($data as $arr) {
            $arr = (array)$arr;
            $output = array_merge($output, $arr);
        }

        return array_flatten($output, $level - 1);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('array_filter_keys')) {
    /**
     * Removes all elements that are in $filter_keys from the array, returns the filtered
     * list
     *
     * @param array $data
     * @param array $filter_keys
     *
     * @return array
     */
    function array_filter_keys(array $data, array $filter_keys): array
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $filter_keys, true)) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('any')) {
    /**
     * Returns true if any element in the return returns true from the callback.
     * If the callback is not set, will just test the truthiness of each element
     *
     * @param array $arr
     * @param mixed $callback should be callable or false
     *
     * @return bool
     */
    function any(array $arr, callable $callback): bool
    {
        foreach ($arr as $key => $value) {
            if (is_callable($callback)) {
                if ($callback([$key, $value])) {
                    return true;
                }
            } elseif ($value) {
                return true;
            }
        }

        return false;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('all')) {
    /**
     *
     * Returns true if all elements in the return returns true from the callback.
     * If the callback is not set, will just test the truthiness of each element
     *
     * @param array $arr
     * @param mixed $callback should be callable or false
     *
     * @return bool
     */
    function all(array $arr, callable $callback): bool
    {
        foreach ($arr as $key => $value) {
            if (is_callable($callback)) {
                if (!$callback([$key, $value])) {
                    return false;
                }
            } elseif (!$value) {
                return false;
            }
        }

        return true;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_ie')) {
    /**
     * A simple function to check whether or not we are running on Internet Explorer
     *
     * @return bool
     */
    function is_ie(): bool
    {
        return preg_match(
                '~MSIE|Internet Explorer~i',
                $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('on_iis')) {
    /**
     * Check if on a Windows IIS Server, return TRUE if yes.
     *
     * @return bool
     */
    function on_iis(): bool
    {
        $software = strtolower($_SERVER['SERVER_SOFTWARE']);

        return strpos($software, 'microsoft-iis') !== false;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('curl_download')) {
    /**
     * cURL download function
     *
     * @param  $file_url
     * @param  $save_path
     *
     * @throws \Exceptions\IO\Filesystem\FileNotReadableException
     * @throws \DomainException
     */
    function curl_download(string $file_url, string $save_path)
    {
        // Open file handler.
        $fp = fopen($save_path, 'w+b');
        // If $fp is FALSE, something went wrong.
        if ($fp === false) {
            throw new FileNotReadableException('Could not open: ' . $save_path);
        }
        // Create a cURL handle.
        $ch = curl_init($file_url);
        // Pass our file handle to cURL.
        curl_setopt($ch, CURLOPT_FILE, $fp);
        // Timeout if the file doesn't download after 20 seconds.
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        // Execute the request.
        curl_exec($ch);
        // If there was an error, throw an Exception
        if (curl_errno($ch)) {
            throw new DomainException(curl_error($ch));
        }
        // Get the HTTP status code.
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // Close the cURL handler.
        curl_close($ch);
        // If we have the go ahead and an HTTP Status OK [HTTP-200-OK]
        if ($statusCode === 200) {
            echo 'Downloaded ' . $save_path;
        } else {
            log_and_exit('Status Code: ' . $statusCode, (int)$statusCode);
        }
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_request_type')) {
    /**
     * Get Request Type
     *
     * Gets the type of server request: GET, POST, PUT, DELETE
     *
     * @return string
     */
    function get_request_type(): string
    {
        // Gets the current request method
        $method = ci()->input->server('REQUEST_METHOD');

        // Return the $method in lower case
        return strtolower($method);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('allowed_request_types')) {
    /**
     * Allowed Request Types
     *
     * Simple security check. Allows only the permitted request types through.
     * All HTTP request types should be lowercase
     *
     * @param  array $requests_arr (lowercase)
     * @param  int   $status_code  The HTTP Status code to return
     *
     * @return string
     */
    function allowed_request_types(array $requests_arr, int $status_code = 403): string
    {
        // Get request type
        $request = get_request_type();
        // Convert request types to lowercase
        foreach ($requests_arr as $k => $req) {
            $requests_arr[$k] = strtolower($req);
        }
        if (!in_array($request, $requests_arr, true)) {
            // Request is denied, send rejection message
            $return = [
                'status'  => 0,
                'message' => 'The request type is not allowed',
            ];
            return_json($return, $status_code);
            exit;
        }

        return $request;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('return_json')) {
    /**
     * Returns the object in JSON form to be consumed by an endpoint
     *
     * @param mixed $json_data    The JSON data to pass into json_encode()
     * @param bool  $pretty_print Enable JSON_PRETTY_PRINT [Default: True]
     * @param int   $status       The HTTP Status Code [Default: 200 - OK]
     */
    function return_json($json_data = null, bool $pretty_print = true, int $status = 200)
    {
        // Assign the JSON to an empty array if $json_data is null
        if (null === $json_data) {
            $json_data = [];
        }
        // Use Codeigniter's Output class to set some basic header data
        ci()->output
            ->set_status_header($status)
            ->set_content_type('application/json');
        // Output the JSON data and exit the script's execution cycle
        echo json_encode($json_data, $pretty_print === true ? JSON_PRETTY_PRINT: null);
        exit;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_vars')) {
    /**
     * Get $_POST Variable data
     *
     * Gets the post variables transmitted via JSON
     *
     * @return mixed
     */
    function get_vars()
    {
        $post = ci()->input->post();
        $get = ci()->input->get();
        $req_type = get_request_type();

        // Different data handling for if there is a PUT request
        if ($req_type === 'put' || $req_type === 'delete') {
            parse_str(urldecode(file_get_contents('php://input')), $phpinput);

        } else {
            $phpinput = json_decode(file_get_contents('php://input'));

        }
        if (null === $post || !$post) {
            $post = [];

        }
        if (null === $get || !$get) {
            $get = [];

        }
        $vars = array_merge($post, $get, $phpinput);

        return (object)$vars;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('json_to_csv')) {
    /**
     * Convert JSON objects to CSV and output/save.
     *
     * JSON should be an array of objects, dictionaries with simple data structures
     * and the same keys in each object. The order of keys is taken from the first
     * element.
     *
     * Example:
     * json:
     * [
     *  { "key1": "value", "kye2": "value", "key3": "value" },
     *  { "key1": "value", "kye2": "value", "key3": "value" },
     *  { "key1": "value", "kye2": "value", "key3": "value" }
     * ]
     *
     * The csv output: (keys will be used for first row):
     * 1. key1, key2, key3
     * 2. value, value, value
     * 3. value, value, value
     * 4. value, value, value
     *
     * Usage:
     *
     *     // echo a JSON string as CSV
     *     json_to_csv($strJson);
     *
     *     // echo a JSON string as CSV
     *     json_to_csv($arrJson);
     *
     *     // save a JSON string as CSV file
     *     json_to_csv($strJson, '/save/path/csvFile.csv');
     *
     *     // save a JSON string as CSV file through the browser (no file saved)
     *     json_to_csv($strJson, false, true);
     *
     * @param       $json
     * @param  bool $csvFilePath
     * @param  bool $boolOutputFile
     *
     * @throws FileNotWritableException
     */
    function json_to_csv($json, bool $csvFilePath = false, bool $boolOutputFile = false)
    {
        // Add the .CSV extension to the CSV filename if !not false
        $csvFilePath !== false ? : str_replace($csvFilePath, $csvFilePath . '.csv', null);
        // See if the string contains something
        if (empty($json)) {
            die('The JSON string is empty');
        }
        // If passed a string, turn it into an array
        if (is_array($json) === false) {
            $json = json_decode($json, true);
        }
        // If a path is included, open that file for handling. Otherwise, use a temp file
        // (for echoing CSV string)
        if ($csvFilePath !== false) {
            $f = fopen($csvFilePath, 'wb');
            if ($f === false) {
                throw new FileNotWritableException("
					Couldn't create the file to store the .CSV or the path is invalid. Make sure you 
					include the full path, INCLUDING the name of the output file AND the .CSV file
					extension (e.g. '../save/path/output.csv')
				");
            }
        } else {
            $boolEchoCsv = true;
            if ($boolOutputFile === true) {
                $boolEchoCsv = false;
            }
            $strTempFile = 'csvOutput' . date('U') . '.csv';
            $f = fopen($strTempFile, 'wb');
        }
        $firstLineKeys = false;
        foreach ($json as $line) {
            if (empty($firstLineKeys)) {
                $firstLineKeys = array_keys($line);
                fputcsv($f, $firstLineKeys);
                $firstLineKeys = array_flip($firstLineKeys);
            }
            // Using array_merge is important to maintain the order of keys according
            // to the first element
            fputcsv($f, array_merge($firstLineKeys, $line));
        }
        fclose($f);
        // Take the file and put it to a string/file for output (if no save path was
        // included in function arguments)
        if ($boolOutputFile === true) {
            if ($csvFilePath !== false) {
                $file = $csvFilePath;
            } else {
                $file = $strTempFile;
            }
            // Output the file to the browser (for open/save)
            if (file_exists($file)) {
                ci()->output
                    ->set_content_type('text/csv')
                    ->set_header('Content-Disposition: attachment; filename=' . basename($file))
                    ->set_header('Content-Length: ' . filesize($file));
                readfile($file);
            }
        } elseif ($boolEchoCsv === true) {
            if (($handle = fopen($strTempFile, 'rb')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    echo implode(',', $data);
                    echo '<br />';
                }
                fclose($handle);
            }
        }
        // Delete the temp file
        unlink($strTempFile);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('json_csv')) {
    /**
     * A short method of creating CSV from JSON data
     *
     * @param string $jsonString
     * @param string $csvFileName
     */
    function json_csv(string $jsonString, string $csvFileName = 'example.csv')
    {
        //Decode the JSON and convert it into an associative array.
        $jsonDecoded = json_decode($jsonString, true);
        // Open file pointer.
        $fp = fopen($csvFileName, 'w+b');
        // Loop through the associative array.
        foreach ($jsonDecoded as $row) {
            // Write the row to the CSV file.
            fputcsv($fp, $row);
        }
        // Finally, close the file pointer.
        fclose($fp);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('pretty_dump')) {
    /**
     * A prettier version of var_dump() and print_r()
     *
     * @param        $var_expression
     * @param string $dump_type
     * @param bool   $use_pre_tags
     */
    function pretty_dump($var_expression, string $dump_type = 'print_r', bool $use_pre_tags = true)
    {
        if ($use_pre_tags) {
            switch ($dump_type) {
                case 'var_dump':
                    echo '<pre>';
                    var_dump($var_expression);
                    echo '</pre>';
                    exit();
                    break;
                case 'print_r':
                    echo '<pre>';
                    print_r($var_expression);
                    echo '</pre>';
                    exit();
                    break;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($var_expression);
        exit;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_dates_query')) {
    /**
     * @param        $start
     * @param        $end
     * @param string $date_field
     *
     * @return string
     */
    function get_dates_query($start, $end, string $date_field = 'custom_date_field'): string
    {
        $query = "SELECT '{$start}' AS {$date_field} \n";
        $current = $start;
        while ($current < $end) {
            $current = date('Y-m-d', strtotime($current . ' +1 day'));
            $query .= "UNION SELECT '" . $current . "' \n";
        }

        return $query;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('clean_string')) {
    /**
     * @param $str_text
     *
     * @return mixed
     */
    function clean_string($str_text)
    {
        $utf8 = [
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u'  => 'A',
            '/[ÍÌÎÏ]/u'   => 'I',
            '/[íìîï]/u'   => 'i',
            '/[éèêë]/u'   => 'e',
            '/[ÉÈÊË]/u'   => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u'  => 'O',
            '/[úùûü]/u'   => 'u',
            '/[ÚÙÛÜ]/u'   => 'U',
            '/ç/'         => 'c',
            '/Ç/'         => 'C',
            '/ñ/'         => 'n',
            '/Ñ/'         => 'N',
            '/–/'         => '-',
            '/[’‘‹›‚]/u'  => ' ',
            '/[“”«»„]/u'  => ' ',
            '/ /'         => ' ',
        ];

        return preg_replace(array_keys($utf8), array_values($utf8), $str_text);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('parse_obj_array_to_ids_array')) {
    /**
     * @param        $obj_array
     * @param string $id_name
     *
     * @return array
     */
    function parse_obj_array_to_ids_array($obj_array, string $id_name = 'id'): array
    {
        $arr = [];
        foreach ($obj_array as $row) {
            $arr[] = $row->$id_name;
        }

        return $arr;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('obj_array_to_indexed_array')) {
    /**
     * Convert an object array to an index array
     *
     * @param $obj_array
     * @param $index_field
     * @param $value_field
     *
     * @return array
     */
    function obj_array_to_indexed_array($obj_array, $index_field, $value_field): array
    {
        $value_type = '';
        $arr = [];
        foreach ((array)$obj_array as $row) {
            switch ($value_type) {
                case 'bool':
                    $arr[$row->$index_field] = (bool)$row->$value_field;
                    break;
                case 'int':
                    $arr[$row->$index_field] = (int)$row->$value_field;
                    break;
                case 'float':
                    $arr[$row->$index_field] = (float)$row->$value_field;
                    break;
                case 'double':
                    $arr[$row->$index_field] = (double)$row->$value_field;
                    break;
                default:
                    $arr[$row->$index_field] = $row->$value_field;
                    break;
            }
        }

        return $arr;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('obj_to_array')) {
    /**
     * Convert an object to an array
     *
     * @param $object
     *
     * @return array
     */
    function obj_to_array($object): array
    {
        $array = [
            // Intentionally left blank...
        ];
        foreach ($object as $key => $value) {
            if (is_object($value)) {
                $array[$key] = obj_to_array($value);
            } elseif (is_array($value)) {
                $array[$key] = obj_to_array($value);
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('obj_to_array_dirty')) {
    /**
     * Converts an object to an array in a `dirtier` way...
     *
     * @param mixed $object The object to convert
     * @param bool  $assoc  Cast as an associative array?
     */
    function obj_to_array_dirty($object, bool $assoc = true)
    {
        echo json_decode(json_encode($object), $assoc);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('in_array_assoc')) {
    /**
     * Checks if a value exists in an array
     *
     * @param  mixed $needle   The needle to find in the haystack
     * @param  array $haystack The haystack containing the needle
     * @param  bool  $strict
     *
     * @return bool            TRUE upon success and FALSE on failure
     */
    function in_array_assoc($needle, $haystack, $strict = false): bool
    {
        $return = false;
        foreach ($haystack as $k => $v) {
            if (in_array($k, $needle, $strict)) {
                $return = true;
                break;
            }
        }

        return $return;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_array_assoc')) {
    /**
     * Finds whether a variable is an associative arrays
     *
     * @param  array $arr The associative array
     *
     * @return bool       TRUE upon success and FALSE on failure
     */
    function is_array_assoc(array $arr = [])
    {
        return is_array($arr) && array_diff_key($arr, array_keys(array_keys($arr)));
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('is_array_multi')) {
    /**
     * Finds whether a variable is an multidimensional arrays
     *
     * @param  array $arr The multidimensional array
     *
     * @return bool       TRUE upon success and FALSE on failure
     */
    function is_array_multi(array $arr = []): bool
    {
        rsort($arr);

        return isset($arr[0]) && is_array($arr[0]);
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_file_or_folder')) {
    /**
     * Get a file or a folder
     *
     * @param  $data2
     *
     * @return bool|string
     */
    function get_file_or_folder($data2)
    {
        $data = str_replace(' ', '', $data2);
        if ($data === '.' || $data === '..') {
            return false;
        }
        $arr = explode('.', $data);
        if (empty($arr[1])) {
            /* Folder */
            return 'folder';
        } else {
            $img = ['jpg', 'png', 'jpeg', 'gif'];
            $file = ['html', 'css', 'js', 'php'];
            /* File */
            if ($arr[1] === 'zip') {
                return 'zip';
            } elseif (in_array($arr[1], $img, true)) {
                return 'img';
            } else {
                return 'file';
            }
        }
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('visitors_ip')) {
    /**
     * @return mixed
     */
    function visitors_ip()
    {
        $client_ip = @$_SERVER['HTTP_CLIENT_IP'];
        $forwarded_ip = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote_ip = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client_ip, FILTER_VALIDATE_IP)) {
            $ip_address = $client_ip;
        } elseif (filter_var($forwarded_ip, FILTER_VALIDATE_IP)) {
            $ip_address = $forwarded_ip;
        } else {
            $ip_address = $remote_ip;
        }

        return $ip_address;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('visitors_ip_short')) {
    /**
     * @return null|string
     */
    function visitors_ip_short(): ?string
    {
        return $_SERVER['HTTP_X_REAL_IP']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER['REMOTE_ADDR']
            ?? null;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_client_ip')) {
    /**
     * @return null|string
     */
    function get_client_ip()
    {
        $result = null;
        $ipSourceList = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];
        foreach ($ipSourceList as $ipSource) {
            if (isset($_SERVER[$ipSource])) {
                $result = $_SERVER[$ipSource];
                echo $result . "\t" . $ipSource . " \n";
                break;
            }
        }

        return $result;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('get_real_ip')) {
    /**
     * @return array|false|string
     */
    function get_real_ip()
    {
        if ($_SERVER !== null) {
            if (isset($_SERVER['	'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (strpos($ip, ',')) {
                    $exp_ip = explode(',', $ip);
                    $ip = $exp_ip[0];
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
                if (strpos($ip, ',')) {
                    $exp_ip = explode(',', $ip);
                    $ip = $exp_ip[0];
                }
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $ip = getenv('HTTP_CLIENT_IP');
            } else {
                $ip = getenv('REMOTE_ADDR');
            }
        }

        return $ip;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('UUIDv4')) {
    /**
     * Generates a random UUID using the secure RNG.
     *
     * Returns Version 4 UUID format: xxxxxxxx-xxxx-4xxx-Yxxx-xxxxxxxxxxxx where x
     * is any random hex digit and Y is a random choice from 8, 9, a, or b.
     *
     * Credit goes to jreklund for providing this function:
     *
     * @link   https://forum.codeigniter.com/thread-72048-post-359095.html#pid359095
     *
     * @return string The UUID
     *
     * @throws \Exception
     */
    function UUIDv4(): string
    {
        // Generate the UUID
        try {
            $bytes = random_bytes(16);
            $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
            $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
            $uuid = \vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
        } catch (Exception $e) {
            throw new Exception('Cannot generate UUID()');
        }

        // Return the UUID
        return $uuid;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if (!function_exists('parse_link_header')) {
    /**
     * A function to help with defining the use of Web links in HTTP
     * headers with the Link header field, as per RFC5988.
     *
     * @link   https://gist.github.com/natanfelles/5175e0544ff471fa90f2354327631b8c
     * @link   https://tools.ietf.org/html/rfc5988
     *
     * @param  $header
     *
     * @return array
     *
     * @throws RuntimeException
     */
    function parse_link_header($header)
    {
        if ('' === $header) {
            throw new \RuntimeException("input must not be of zero length");
        }
        $parts = explode(',', $header);
        $links = [];
        foreach ($parts as $p) {
            $section = explode(';', $p);
            if (count($section) !== 2) {
                throw new \RuntimeException("section could not be split on ';'");
            }
            $url = trim(preg_replace("/<(.*)>/", '$1', $section[0]));
            $name = trim(preg_replace("/rel=\"(.*)\"/", '$1', $section[1]));
            $links[$name] = $url;
        }
        return $links;
    }
}
// ----------------------------------------------------------------------------
// When/If the function does not exist, let's create it!
if ( ! function_exists('translate_slug'))
{
    /*
     * Translate a slugified string
     *
     * @param  string $string The String to slugify
     *
     * @return string
     */
    function translate_slug(string $string): string
    {
    	// Load the helpers
        load_helper('text');
        load_helper('url');

        // Replace unsupported characters
        $string = str_replace(["'", ".", "²"], ['-', '-', '2'], $string);

        // Slugify and return the string
        return url_title(convert_accented_characters($string), 'dash', true);
    }
}
// ----------------------------------------------------------------------------
