<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'public_assets_db');
define('DB_USER', 'root');
define('DB_PASS', '');

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