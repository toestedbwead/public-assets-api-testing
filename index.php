<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

// Show error if login failed (from login_process.php)
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Asset and Facility Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; }
        .form-container { max-width: 400px; margin: 100px auto; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="form-container">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-green-600">Public Asset and Facility Management System</h1>
            <p class="text-gray-600 mt-2">Login with your central GoServePH credentials</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login_process.php" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500" placeholder="your@email.com">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition">
                Login
            </button>
        </form>

        <p class="text-center text-gray-500 text-sm mt-6">
            Don't have an account? <a href="https://goserveph.com/register.php?return_to=<?php echo urlencode('https://public-asset.goserveph.com/index.php');?>" class="text-green-600 hover:underline">Register on the main portal</a>
        </p>
    </div>

</body>
</html>