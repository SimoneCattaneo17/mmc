<?php

use LDAP\Result;

function connect($sql){
    $ip = '127.0.0.1';
    $username = 'root';
    $pwd = '';
    $database = 'my_cattaneosimone';
    $connection = new mysqli($ip, $username, $pwd, $database);

    if($connection->connect_error) {
        die('C/errore: ' . $connection->connect_error);
    }

    $result = $connection->query($sql);

    return $result;
}
?>