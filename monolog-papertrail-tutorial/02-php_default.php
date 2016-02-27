<?php

date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

$logger = new Logger('demo_logger');

// Register the logger to handle PHP errors and exceptions
ErrorHandler::register($logger);

// Add log file handler
$logger->pushHandler(new StreamHandler(__DIR__ . '/log/php_errors.log', Logger::WARNING));

// Throw an exception to test logger
throw new Exception('Oops');
