<?php
/**
 * Home Page Tests
 *
 * Contains PHPUnit/Mink functional tests for the Home Page
 *
 * @author George Webb <george@gawdev.co.uk>
 */

namespace Gaw508\MinkFunctionalTestingTutorial;

class HomePageTest extends MinkTestCase
{
    /**
     * @var DocumentElement  the mink document element
     */
    protected $page;

    /**
     * This function runs before each test
     * Navigates the user to the home page
     */
    protected function setUp()
    {
        static::$session->visit('http://mink-test-site.webb.uno/');
        $this->page = static::$session->getPage();
    }

    /**
     * Test the page header is correct
     */
    public function testPageHeader()
    {
        $header = $this->page->find('css', 'h1');
        $this->assertEquals(
            "Mink Tutorial Test Site",
            $header->getText()
        );
    }

    /**
     * Test the functionality of the feelings select box
     */
    public function testFeelingsSelectBox()
    {
        // Get the select element and an array of the option elements within it
        $select = $this->page->find('css', '#feelings');
        $options = $select->findAll('css', 'option');
        // Get the span containing the feeling text
        $feeling_span = $this->page->find('css', '.i-feel');

        // Get the value of each option
        $option_values = array();
        foreach ($options as $option) {
            $option_values[] = $option->getValue();
        }

        // Assert that the options are happy, sad and angry
        $this->assertEquals(
            array(
                'happy',
                'sad',
                'angry'
            ),
            $option_values
        );

        // Check the initial text value is happy and the select is initially happy
        $this->assertEquals('happy', $select->getValue());
        $this->assertEquals('happy', $feeling_span->getText());

        // Change the value of the select to angry and check the text
        $select->selectOption('angry');
        $this->assertEquals('angry', $feeling_span->getText());
    }
}
