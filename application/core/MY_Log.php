<?php \defined('BASEPATH') || exit('No direct script access allowed.');
// IMPORT DEPENDENCIES --------------------------------------------------------
// Monolog Library
use Monolog\{
    Processor\IntrospectionProcessor,
    Formatter\GelfMessageFormatter,
    Handler\RotatingFileHandler,
    Handler\SyslogUdpHandler,
    Formatter\LineFormatter,
    Handler\NewRelicHandler,
    Handler\HipChatHandler,
    Handler\StreamHandler,
    Handler\GelfHandler,
    ErrorHandler,
    Logger
};
// Gelf Library
use Gelf\{
    Transport\UdpTransport,
    Publisher
};

/**
 * CodeIgniter Monolog Implementation. An upgraded/modern version of CodeIgniter
 * Monolog Plus by Josh Highland.
 *
 * @category Core Files
 * @author   Josh Highland
 * @author   Jason Napolitano <jnapolitanoit@gmail.com>
 * @updated  09.04.2018
 *
 * @license  2-clause BSD
 * @version  1.3.2 [major.minor.patch]
 * @since    1.0.0 [major.minor.patch]
 *
 * @link     https://opensource.org/licenses/BSD-2-Clause
 * @link     https://www.codeigniter.com/user_guide/general/core_classes.html
 *
 * @link     https://github.com/Seldaek/monolog
 */
class MY_Log
{
    // CodeIgniter log levels
    protected $_levels = [
        'OFF'   => '0',
        'ERROR' => '1',
        'DEBUG' => '2',
        'INFO'  => '3',
        'ALL'   => '4',
    ];

    // Configuration array
    protected $config = [];

    // ------------------------------------------------------------------------

    /**
     * Prepare the logging environment
     *
     * @throws \Exception
     */
    public function __construct()
    {
        // copied functionality from system/core/Common.php, as the whole CI infrastructure is not available yet
        if (!defined('ENVIRONMENT') || !file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/monolog.php')) {
            require_once APPPATH . 'config/monolog.php';
        } elseif (defined('ENVIRONMENT') || file_exists($file_path = APPPATH . 'config/' . ENVIRONMENT . '/monolog.php')) {
            require_once APPPATH . 'config/' . ENVIRONMENT . '/monolog.php';
        } else {
            log_message('debug', 'monolog.php config file does not exist');
            exit(APPPATH . 'config/' . ENVIRONMENT . '/monolog.php config does not exist');
        }

        /**
         * Make $config from config/monolog.php accessible to $this->write_log()
         */
        $this->config = $config;
        $this->log = new Logger($this->config['channel']);

        // detect and register all PHP errors in this log hence forth
        ErrorHandler::register($this->log);
        if ($this->config['introspection_processor']) {
            // add controller and line number info to each log message
            $this->log->pushProcessor(new IntrospectionProcessor());
        }
        // decide which handler(s) to use
        foreach ($this->config['handlers'] as $value) {
            switch ($value) {
                case 'file':
                    $handler = new RotatingFileHandler($this->config['file_logfile']);
                    $formatter = new LineFormatter(null, null, $this->config['file_multiline']);
                    $handler->setFormatter($formatter);
                    break;
                case 'ci_file':
                    $handler = new RotatingFileHandler($this->config['ci_file_logfile']);
                    $formatter = new LineFormatter("%level_name% - %datetime% --> %message% %extra%\n", null,
                        $this->config['ci_file_multiline']);
                    $handler->setFormatter($formatter);
                    break;
                case 'new_relic':
                    $handler = new NewRelicHandler(Logger::ERROR, true, $this->config['new_relic_app_name']);
                    break;
                case 'hipchat':
                    $handler = new HipChatHandler(
                        $this->config['hipchat_app_token'],
                        $this->config['hipchat_app_room_id'],
                        $this->config['hipchat_app_notification_name'],
                        $this->config['hipchat_app_notify'],
                        $this->config['hipchat_app_loglevel']
                    );
                    break;
                case 'stderr':
                    $handler = new StreamHandler('php://stderr');
                    break;
                case 'papertrail':
                    $handler = new SyslogUdpHandler($this->config['papertrail_host'],
                        $this->config['papertrail_port']);
                    $formatter = new LineFormatter('%channel%.%level_name%: %message% %extra%', null,
                        $this->config['papertrail_multiline']);
                    $handler->setFormatter($formatter);
                    break;
                case 'gelf':
                    $transport = new UdpTransport($this->config['gelf_host'], $this->config['gelf_port']);
                    $publisher = new Publisher($transport);
                    $formatter = new GelfMessageFormatter();
                    $handler = new GelfHandler($publisher);
                    $handler->setFormatter($formatter);
                    break;
                default:
                    exit('log handler not supported: ' . $value . "\n");
            }
            $this->log->pushHandler($handler);
        }
        // Debug log the message that this base class was properly constructed and
        // the rest of the application is ready to continue
        $this->write_log('info', __CLASS__ . ' has been initialized.');
    }

    // ------------------------------------------------------------------------

    /**
     * Write to defined logger. Is called from CodeIgniters native log_message()
     * helper function
     *
     * @param  string $level   The log level
     * @param  string $message The log message
     *
     * @return bool
     */
    public function write_log(string $level = 'error', string $message): bool
    {
        $level = strtoupper($level);
        // verify error level
        if (!isset($this->_levels[$level])) {
            $this->log->addError('unknown error level: ' . $level);
            $level = 'ALL';
        }
        // filter out anything in $this->config['exclusion_list']
        if (!empty($this->config['exclusion_list'])) {
            foreach ($this->config['exclusion_list'] as $findme) {
                $pos = strpos($message, $findme);
                if ($pos !== false) {
                    // just exit now - we don't want to log this error
                    return true;
                }
            }
        }
        if ($this->_levels[$level] <= $this->config['threshold']) {
            switch ($level) {
                case 'ERROR':
                    $this->log->addError($message);
                    break;
                case 'DEBUG':
                    $this->log->addDebug($message);
                    break;
                case 'ALL':
                case 'INFO':
                    $this->log->addInfo($message);
                    break;
            }
        }

        return true;
    }

    // ------------------------------------------------------------------------
}
