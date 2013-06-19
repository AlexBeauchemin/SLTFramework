<?php

class Model {
    /** @var App */
    public $app;
    public $db;

    function __construct(App $app)
    {
        $this->app = $app;

        //TODO: Put this in the app or in a database object, the database should not be initiated on every model created

        $host = $this->app->getConfig('host');
        $user = $this->app->getConfig('username');
        $pass = $this->app->getConfig('password');
        $database = $this->app->getConfig('database');

        $this->db = new PDO('mysql:dbname=' . $database . ';host=' .$host . ';charset=utf8', $user, $pass);
        $this->db->exec("SET CHARACTER SET utf8");
        
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->init();
    }

    function init()
    {

    }

//    function getData($key)
//    {
//        return $this->$key;
//    }

//    function setData($key,$val)
//    {
//        if(!is_array($key)){
//            if(isset($this->$key)) {
//                $this->$key = $val;
//            }
//        }
//        else {
//            foreach($key as $count => $item) {
//                if(isset($this->$item)) {
//                    $this->$item = $val[$count];
//                }
//            }
//        }
//    }
}