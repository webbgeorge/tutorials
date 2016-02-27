<?php

/**
 * Run this script to monitor email_queue beanstalk tube
 *
 * Beanstalk must be running locally before running this script
 */

require_once __DIR__ . '/vendor/autoload.php';

$pheanstalk = new \Pheanstalk\Pheanstalk('127.0.0.1');

// Continuously loop to endlessly monitor beanstalk queue
while (true) {
    // Checks beanstalk connection
    if (!$pheanstalk->getConnection()->isServiceListening()) {
        echo "error connecting to beanstalk, sleeping for 5 seconds... \n";

        // Sleep for 5 seconds
        sleep(5);

        // Skip to next iteration of loop
        continue;
    }

    // Get job from queue, if none wait for a job to be available
    $job = $pheanstalk
        ->watch('email_queue')
        ->ignore('default')
        ->reserve();

    $email = json_decode($job->getData(), true);

    try {
        // Send the email using the mandrill api
        $mandrill = new Mandrill('[MANDRILL-API-KEY');

        $message = array(
            'html' => $email['body'],
            'subject' => $email['subject'],
            'from_email' => $email['from'],
            'to' => array(
                array(
                    'email' => $email['to'],
                )
            )
        );

        // Send the message
        $result = $mandrill->messages->send($message);

        // Remove the job from the queue
        $pheanstalk->delete($job);

        echo "message successfully sent \n";

    } catch (Exception $e) {
        echo "Error sending message - {$e->getMessage()} \n";
    }
}
