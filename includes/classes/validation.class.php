<?php

class Validation
{
    private $options;

    function __construct()
    {
        $this->options = array(
            'options' => array(
                'default' => null
            )
        );
    }

    function cleanup($data) {
        return trim($data);
    }

    function length($data,$min=-1,$max=-1) {
        $data = $this->cleanup($data);
        $length = strlen($data);
        if($min>0)
            if($length < $min) return null;
        if($max>0)
            if($length > $max) return null;
        return $data;
    }

    function is_bool($email = null) {
        return filter_var($email, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    function is_email($email = null) {
        $email = $this->cleanup($email);
        return filter_var($email, FILTER_VALIDATE_EMAIL, $this->options);
    }

    function is_int($data = null) {
        return filter_var($data, FILTER_VALIDATE_INT, $this->options);
    }

    function is_numeric($data = null) {
        return filter_var($data, FILTER_VALIDATE_FLOAT, $this->options);
    }
}