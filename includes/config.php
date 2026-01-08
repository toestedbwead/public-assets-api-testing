<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'publ_pubasset');
define('DB_USER', 'publ_lead_programmer');
define('DB_PASS', '0000');


define('CITIZEN_API_URL', 'http://localhost/citizen-information-api/api_receive.php'); // Your local XAMPP
define('CITIZEN_API_KEY', 'capstone_key_2024'); // Must match Citizen system

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>