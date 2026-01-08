<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'publ_pubasset');
define('DB_USER', 'publ_lead_programmer');
define('DB_PASS', '9$TT81Vp8NnX&vIU');

// Citizen system API URL (for later - we'll use a mock URL first)
define('CITIZEN_API_URL', 'https://mockapi.io/your-mock-endpoint'); // Example placeholder
define('CITIZEN_API_KEY', 'test_key_123'); // Example placeholder

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>