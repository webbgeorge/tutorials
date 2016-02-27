<?php
/**
 * Bootstrap file which is run before tests are started. Includes necessary files.
 */

// Include the autoload file for composer
require_once dirname(__DIR__) . "/vendor/autoload.php";

//Include our mink test case
require_once __DIR__ . "/MinkTestCase.php";
