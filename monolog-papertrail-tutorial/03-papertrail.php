<?php

date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\ErrorHandler;

$logger = new Logger('demo_logger');

// Register the logger to handle PHP errors and exceptions
ErrorHandler::register($logger);

// Add log file handler
$logger->pushHandler(new StreamHandler(__DIR__ . '/log/php_errors.log', Logger::ERROR));

// Add the papertrail handler
$logger->pushHandler(new SyslogUdpHandler("<host>.papertrailapp.com", XXXXX, LOG_USER, Logger::WARNING));

$logger->addInfo('Something happened and it was fine');
$logger->addWarning('Should not have done that');
$logger->addError('Oh no, its broken');

// Throw an exception to test logger
throw new Exception('Oops');
