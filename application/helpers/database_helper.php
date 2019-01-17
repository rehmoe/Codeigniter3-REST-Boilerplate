<?php
// CLASS/INTERFACE IMPORTS ----------------------------------------------------
use Faker\{
    Generator, Factory,
};
/**
 * This is a set of useful helper functions that can be used application wide and
 * includes access to functions for working with database classes, migrations and
 * seeds. As well as other helpful features.
 *
 * NOTE: Make sure to run `composer install` and install the dependencies for this
 * helper file.
 *
 * @package  Helpers
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @updated  12.06.2018
 *
 * @license  MIT License
 *
 * @link     https://www.codeigniter.com/userguide3/general/helpers.html
 * @link     https://github.com/fzaninotto/faker
 * @link     https://opensource.org/licenses/MIT
 */

// ----------------------------------------------------------------------------
// GENERATOR FUNCTIONS

// If the function does not exist, let's create it!
if (!function_exists('faker')) {
    /**
     * A Faker instance for database seeding
     *
     * Default Loading:
     * $this->load->helper('database'); // Load the helper
     *
     * Using app_Helper.php for loading:
     * load_helper('database');         // Load the helper
     *
     * Usage:
     * $address = faker()->getAddress;
     * $email   = faker()->getEmail;
     * etc...
     *
     * @return \Faker\Generator
     */
    function faker(): Generator
    {
        return Factory::create();
    }
}
