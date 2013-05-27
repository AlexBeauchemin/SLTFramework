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

    function length($value, $min = -1, $max = -1) {
        $value = $this->cleanup($value);
        $length = strlen($value);
        if($min>0)
            if($length < $min) return null;
        if($max>0)
            if($length > $max) return null;
        return $value;
    }

    function is_bool($value = null) {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    function is_email($email = null) {
        $email = $this->cleanup($email);
        return filter_var($email, FILTER_VALIDATE_EMAIL, $this->options);
    }

    function is_int($value = null) {
        return filter_var($value, FILTER_VALIDATE_INT, $this->options);
    }

    function is_numeric($value = null) {
        return filter_var($value, FILTER_VALIDATE_FLOAT, $this->options);
    }

    function validate($elements) {
        $errors = array();
        foreach($elements as $element) {
            $id = $element['id'];
            $validation = $element['validation'];
            $value = $element['value'];
            $error = (isset($element['error']) ? $element['error'] : 'Validation error.');

            if($validation == "length") {
                $min = (isset($element['min']) ? $element['min'] : -1);
                $max = (isset($element['max']) ? $element['max'] : -1);
                if($this->$validation($value,$min,$max)==null) {
                    $errors[$id] = $error;
                }
            }
            else {
                if($this->$validation($value)==null) {
                    $errors[$id] = $error;
                }
            }

        }

        return $errors;
    }
}