<?php
    require_once 'values.php'; //access the login values
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        echo 'DB connected';
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>