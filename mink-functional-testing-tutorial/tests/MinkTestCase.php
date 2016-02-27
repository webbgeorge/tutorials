<?php
/**
 * Mink Test Case
 *
 * PHPUnit Test case template for Mink functional tests.
 *
 * @author George Webb <george@gawdev.co.uk>
 */

namespace Gaw508\MinkFunctionalTestingTutorial;

use Behat\Mink\Driver\SahiDriver;
use Behat\Mink\Session;
use Behat\Mink\Driver\DriverInterface;

class MinkTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DriverInterface  the Mink driver object
     */
    protected static $driver;

    /**
     * @var Session  the Mink session
     */
    protected static $session;

    /**
     * Function run before the first test in the class
     * Set up the Sahi driver and start a session, which will open the browser
     */
    public static function setUpBeforeClass()
    {
        static::$driver = new SahiDriver('chrome');
        static::$session = new Session(static::$driver);
        static::$session->start();
    }

    /**
     * Function run after each test in the class
     * Resets the session, clearing cookies etc.
     */
    protected function tearDown()
    {
        static::$session->reset();
    }

    /**
     * Function run after the last test in the class
     * Stops the session, and the browser is closed.
     */
    public static function tearDownAfterClass()
    {
        static::$session->stop();
    }
}
