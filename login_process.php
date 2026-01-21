<?php
session_start();
require_once 'includes/central_db.php';  // Your central DB connection

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$error = '';

if (empty($email) || empty($password)) {
    $error = "Email and password are required.";
} else {
    // Prepare and execute query
    $stmt = $central_conn->prepare("
        SELECT id, password, first_name, last_name, role 
        FROM users 
        WHERE email = ?
    ");

    if (!$stmt) {
        $error = "Database error: " . $central_conn->error;
    } else {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashed_password, $first_name, $last_name, $role);

        if ($stmt->fetch() && password_verify($password, $hashed_password)) {
            // Login successful
            $_SESSION['logged_in']   = true;
            $_SESSION['user_id']     = $id;
            $_SESSION['email']       = $email;
            $_SESSION['full_name']   = trim("$first_name " . ($last_name ?? ''));
            $_SESSION['role']        = $role;

            // Optional: you can log last login time here if you want to UPDATE the table
            // (but since it's read-only user, skip or use a separate update user if needed)

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }

        $stmt->close();
    }
}

if (!empty($error)) {
    $_SESSION['login_error'] = $error;
    header("Location: index.php");
    exit;
}

// Close connection (good practice)
$central_conn->close();
?>