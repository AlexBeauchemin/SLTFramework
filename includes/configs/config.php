<?php
/*
Use environement variables to define your environments : APPLICATION_ENV
For example, if the environment variable is set to DEV , the file config-dev.php will be loaded instead , config-staging.php if the variable is set to STAGING
This file if for production, where no environment variable is set , or will be loaded if no file match with the environement variable
You can use the url as an alternative to set the correct config values
*/


$config = array(

    //Database
    'username'           => 'root',
    'password'           => '',
    'database'           => '',
    'host'               => 'localhost',

    //Multilang
    'multi_lang'         => true,
    'multi_lang_default' => 'en', //need multi_lang to be true

    //Facebook
    'app_id'             => '',
    'app_secret'         => '',
    'app_url'            => 'https://apps.facebook.com/myapp/', //if facebook app is needed

    //Google analytics
    'ga_account'         => '',
    'ga_domain'          => '',

    //Contest autoclose
    'end_date'           => null, // new DateTime('2013-05-23 00:00'),
    'end_view'           => 'close', //view loaded when the contest is closed

    //Others
    'default_views'      => array('elements/header', 'currentPage', 'elements/footer'), //default views loaded for a page , currentPage is the name of the controller/view
    'use_require'        => false, //use require.js
    'env'                => 'prod',
    'url'                => 'http://framework.local/',

);



/* If environement variables are not used :

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
    ...
}
else
{
    ...
}

*/
