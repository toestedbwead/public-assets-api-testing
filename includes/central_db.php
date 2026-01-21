<?php

$host     = 'localhost';
$dbname   = 'gose_user_db';          
$username = 'root';                  
$password = '';                

$central_conn = mysqli_connect($host, $username, $password, $dbname);

if (!$central_conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: set charset
mysqli_set_charset($central_conn, "utf8mb4");
?>