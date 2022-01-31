<?php

$connection = mysqli_connect('localhost', 'root', '', 'cms');

if($connection) {
}
    /*
    OTHER METHOD
    $db_user = 'localhost';
    $db_users = 'localhost';
    
    OR
    Best method:
    $db['db_host'] = "localhost";
    $db['db_users'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "cms";
    
    foreach($db as $key => $value) {
    
    define(strtoupper($key), $value); // Conveted to constants
    }
    
    */
?>