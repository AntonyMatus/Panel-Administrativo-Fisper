<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', '127.0.0.1');
define('DATABASE', 'fisper_db');
 

$link = 'mysql:host=127.0.0.1; dbname=fisper_db';
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'fisper_db';

try {
    $pdo = new PDO($link,$username, $password);
    // $connection = mysqli_connect("$host","$username","$password","$database");
   
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>