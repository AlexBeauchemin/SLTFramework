<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

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
    'end_date'           => null, // new DateTime('2013-05-23 00:00')
    'end_view'           => 'close', //view loaded when the contest is closed

    //Others
    'default_views'      => array('elements/header', 'currentPage', 'elements/footer'), //default views loaded for a page , currentPage is the name of the controller/view
    'use_require'        => false, //use require.js
    'env'                => 'dev',
    'url'                => 'http://framework.local/',

);