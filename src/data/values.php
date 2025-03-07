<?php 
    $catDesc = array("Bob","Larry","Win","Labs");

    $host = "localhost";
    $username = "illia";
    $password = "toforget";
    $dbname = "webdevfinalproject"; 
    $dsn = "mysql:host=$host;dbname=$dbname";
    $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
?>