<?php
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

/* Load includes */
define('DOCROOT', dirname(__FILE__));
include DOCROOT . '/includes/config.php';
include DOCROOT . '/includes/autoloader.php';
include DOCROOT . '/includes/app.php';

$app = new App();

