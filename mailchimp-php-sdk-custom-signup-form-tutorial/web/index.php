<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$app = new \Slim\Slim(array(
    'templates.path' => dirname(__DIR__) . '/templates'
));

$app->get('/', function () use ($app) {
    $app->render('home.php');
});

$app->post('/newsletter/subscribe', function () use ($app) {
    $first_name = $app->request->post('first_name');
    $email = $app->request->post('email_address');

    $message = 'Thanks! You\'re now signed up.';

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            $mailchimp = new Mailchimp("[MAILCHIMP-API-KEY]");
            $mailchimp->lists->subscribe(
                "[MAILCHIMP-LIST-ID]",
                array('email' => $email),
                array('FNAME' => $first_name)
            );
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
    } else {
        $message = 'Please enter a valid email address';
    }

    $app->response->setBody(json_encode(array(
        'message' => $message
    )));
});

$app->run();
