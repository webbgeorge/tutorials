Sending PHP email with Mandrill and a Beanstalk queue
===============================================

This repository contains the code used in my tutorial blog post, named as above, found at http://george.webb.uno/

Installation

* Clone the tutorials repository (this repo) and cd to this directory

* Run composer install

* Adjust Mandrill API key in `email_worker.php`

* Start Beanstalkd (see http://kr.github.io/beanstalkd/)

* Run `php send_email.php` to add an email to the queue

* Run `php email_worker.php` to start the worker, which will monitor the queue and send the emails via Mandrill

* See my blog post for more information, see above for link.
