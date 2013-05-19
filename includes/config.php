<?php

$config['app_url'] = 'https://apps.facebook.com/myapp/'; //if facebook app is needed
$config['default_views'] = array('elements/header','currentPage','elements/footer'); //default views loaded for a page , currentPage is the name of the controller/view
$config['end_date'] = new DateTime('2013-05-23 00:00'); //if contest with automatic end date
$config['end_view'] = 'close'; //view loaded when the contest is closed
$config['multi_lang'] = true;
$config['multi_lang_default'] = 'fr'; //need multi_lang to be true
$config['use_require'] = true; //use require.js

//TODO: Change url detection to environement variables (make it an option)

if (strpos($_SERVER['SERVER_NAME'], 'framework.local') !== false)
{

    $config['env'] = 'dev';
    $config['url']      = 'http://framework.local/';
    $config['username'] = 'root';
    $config['password'] = '';
    $config['database'] = '';
    $config['app_id']    = '';
    $config['app_secret'] = '';
    $config['ga_account'] = '';

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

}
elseif (strpos($_SERVER['SERVER_NAME'], 'framework.stage.com') !== false)
{

    $config['env'] = 'staging';
    $config['url']      = 'https://mywebsite.stage.sltech.co/';
    $config['username'] = 'root';
    $config['password'] = '';
    $config['database'] = '';
    $config['app_id']    = '';
    $config['app_secret'] = '';
    $config['ga_account'] = '';

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
else
{
   $config['env'] = 'prod';
   $config['url']      = 'https://framework.sidleetechnologies.com/';
   $config['username'] = 'root';
   $config['password'] = '';
   $config['database'] = '';
   $config['app_id']    = '';
   $config['app_secret'] = '';
   $config['ga_account'] = '';
}
