<?php

// Created by Alex Beauchemin
// Cross-site request forgery protection
// Use PDO for database
// Table fields : 'token' => varchar 255 , 'used' => bool

class CSRF
{
    private $db, // PDO expected
        $table_name = 'csrf';

    function __construct(PDO $db, $table_name = null)
    {
        $this->db = $db;
        if ($table_name) {
            $this->table_name = $table_name;
        }
    }

    function create()
    {
        $token = $this->generateKey();
        try {
            $preparedStatement = $this->db->prepare(
                'INSERT INTO ' . $this->table_name . ' (token) VALUES (:token)'
            );
            $preparedStatement->execute(
                array(
                    ':token' => $this->toHex($token),
                )
            );
        } catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }

        $signed = hash_hmac('sha1', $token, $this->getSessionKey());

        return $this->toHex($token) . ':' . $signed;
    }

    private function getSessionKey()
    {
        if (!isset($_SESSION['csrf_key'])) {
            $_SESSION['csrf_key'] = $this->generateKey();
        }

        return $_SESSION['csrf_key'];
    }

    private function generateKey()
    {
        return mcrypt_create_iv(20, MCRYPT_DEV_URANDOM);
    }

    private function toHex($bytes)
    {
        $m = unpack('h*', $bytes);
        return $m[1];
    }

    private function toBytes($hex)
    {
        return pack('h*', $hex);
    }

    function isValid($token)
    {
        if (preg_match('/^[a-z0-9]+:[a-z0-9]+$/Di', $token) !== 1) {
            return false;
        }

        $tokenParts = explode(':', $token);

        try {
            $tokenBytes = $this->toBytes($tokenParts[0]);
            $signed     = hash_hmac('sha1', $tokenBytes, $this->getSessionKey());

            if ($signed !== $tokenParts[1]) {
                return false;
            }

            $preparedStatement = $this->db->prepare('SELECT * FROM csrf WHERE token = :token AND used = 0');
            $preparedStatement->execute(
                array(
                    ':token' => $tokenParts[0],
                )
            );
            $result = $preparedStatement->fetchAll();
            if (!$result || count($result) === 0) {
                return false;
            }

            $preparedStatement = $this->db->prepare('UPDATE csrf SET used = 1 WHERE token = :token');
            $preparedStatement->execute(
                array(
                    ':token' => $tokenParts[0],
                )
            );
            return true;

        } catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
    }

}