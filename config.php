<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', '127.0.0.1');
define('DATABASE', 'fisper_db');
 

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'fisper_db';

try {
    $connection = mysqli_connect("$host","$username","$password","$database");
   
} catch (Exception $e) {
    exit("Error: " . $e->getMessage());
}
?>