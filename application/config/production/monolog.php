<?php \defined('BASEPATH') || exit('No direct script access allowed.');
/**
 * CodeIgniter Monolog Plus
 *
 * @author Josh Highland <joshhighland@venntov.com>
 * @link   https://github.com/JoshHighland/codeigniter-monolog-plus
 */
/* GENERAL OPTIONS */
$config['handlers'] = [
    //'ci_file', // (un)-comment to enable/disable Codeigniter logger
    'file',      // (un)-comment to enable/disable Monolog logger
];

// valid handlers are ci_file | file | new_relic | hipchat | stderr | papertrail | gelf
$config['channel'] = ENVIRONMENT; // channel name which appears on each line of log

// 'ERROR' => '1', 'DEBUG' => '2', 'INFO' => '3', 'ALL' => '4'
$config['threshold'] = (string)config_item('log_threshold');
$config['introspection_processor'] = true; // add some meta data such as controller and line number to log messages

/*
 * CI FILE - DEFAULT CODEIGNITER LOG FILE STRUCTURE:
 * Log to default CI log directory (must be writable ie. chmod 757).
 * Filename will be encoded to current system date, ie. YYYY-MM-DD-ci.log
 */
$config['ci_file_logfile']   = LOGPATH . 'codeigniter.php';
$config['ci_file_multiline'] = true; //add newlines to the output

/*
 * FILE HANDLER OPTIONS:
 * Log to default CI log directory (must be writable ie. chmod 757).
 * Filename will be encoded to current system date, ie. YYYY-MM-DD-ci.log
*/
$config['file_logfile']   = LOGPATH . 'monolog.php';
$config['file_multiline'] = true; // Add newlines to the output

/*
 * NEW RELIC OPTIONS
 */
$config['new_relic_app_name'] = 'APP NAME - ' . ENVIRONMENT;

/*
 * HIPCHAT OPTIONS
 */
$config['hipchat_app_token']             = '';        // HipChat API Token
$config['hipchat_app_room_id']           = '';        // The room that should be alerted of the message (Id or Name)
$config['hipchat_app_notification_name'] = 'Monolog'; // Name used in the "from" field
$config['hipchat_app_notify']            = false;     // Trigger a notification in clients or not
$config['hipchat_app_loglevel']          = 'WARNING'; // The minimum logging level at which this handler will be triggered

/*
 * PAPER TRAIL OPTIONS
 */
$config['papertrail_host']      = '';   // xxxx.papertrailapp.com
$config['papertrail_port']      = '';   // port number
$config['papertrail_multiline'] = true; // add newlines to the output

/*
 * GELF OPTIONS
 */
$config['gelf_host'] = ''; // xxxx.papertrailapp.com
$config['gelf_port'] = ''; // port number

/*
 * Exclusion list for pesky messages which you may wish to
 * temporarily suppress with strpos() match
 */
$config['exclusion_list'] = [];
