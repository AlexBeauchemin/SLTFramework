<?php

/* Static vars */
define('DOCROOT', dirname(__FILE__));
define('ENVIRONMENT',strtolower(getenv('APPLICATION_ENV')));

/* Load configs */
if(ENVIRONMENT && file_exists(DOCROOT . '/includes/configs/config-' . ENVIRONMENT . '.php')) {
    include DOCROOT . '/includes/configs/config-' . ENVIRONMENT . '.php';
}
else {
    include DOCROOT . '/includes/configs/config.php';
}

/* Includes */
include DOCROOT . '/includes/autoloader.php';
include DOCROOT . '/includes/app.php';

$app = new App();

