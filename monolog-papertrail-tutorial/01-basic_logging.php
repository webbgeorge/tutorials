<?php

date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('demo_logger');

// Add log file handler
$logger->pushHandler(new StreamHandler(__DIR__ . '/log/basic.log', Logger::WARNING));

// A couple of test log messages
$logger->addInfo('Something happened and it was fine');
$logger->addWarning('Should not have done that');
$logger->addError('Oh no, its broken');
