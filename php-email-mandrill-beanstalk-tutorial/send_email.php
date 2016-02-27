<?php

/**
 * Run this script to add an email job to email_queue beanstalk tube
 *
 * Beanstalk must be running locally before running this script
 */

require_once __DIR__ . '/vendor/autoload.php';

$email = array(
    'to' => 'xyz@example.com',
    'from' => 'abc@example.com',
    'subject' => 'Hello',
    'body' => 'Hello old chap!'
);

$pheanstalk = new \Pheanstalk\Pheanstalk('127.0.0.1');

// Add json for job to "email_queue" beanstalk tube
$pheanstalk
    ->useTube('email_queue')
    ->put(json_encode($email));
