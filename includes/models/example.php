<?php

class ExampleModel extends Model
{
    protected $errors,
            $email;

    function init()
    {
        $this->email;
    }


    function save()
    {
        try {
            $preparedStatement = $this->db->prepare(
                "INSERT INTO registrations (email) VALUES (:email)"
            );

            $preparedStatement->execute(
                array(
                    ':email'           => $this->email
                )
            );

        } catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
    }


    function validate()
    {
        $errors = array();

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            array_push(
                $errors,
                array(
                    'en' => 'Invalid Email.',
                    'fr' => 'Courriel invalide.'
                )
            );
        }

        return $errors;
    }

    function setData($key, $val)
    {
        if (!is_array($key)) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        } else {
            foreach ($key as $count => $item) {
                if (isset($this->$item)) {
                    $this->$item = $val[$count];
                }
            }
        }
    }



}