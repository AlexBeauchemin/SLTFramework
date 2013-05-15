<?php

$config['end_date'] = new DateTime('2013-05-23 00:00');
$config['end_view'] = 'close';
$config['app_url'] = 'https://apps.facebook.com/myapp/';
$config['default_lang'] = 'fr';
$config['default_views'] = array('elements/header','currentPage','elements/footer');
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
    $config['ga_account'] = 'UA-29208382-23';

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
