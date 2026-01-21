<?php
session_start();

// If not logged in, redirect back to login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}

$full_name = $_SESSION['full_name'] ?? 'User';
$role = $_SESSION['role'] ?? 'citizen';
$email = $_SESSION['email'] ?? 'unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Asset and Facility Management System Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f3f4f6; }
    </style>
</head>
<body class="min-h-screen">

    <!-- Navbar -->
    <nav class="bg-green-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Public Asset and Facility Management System</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm">Welcome, <?php echo htmlspecialchars($full_name); ?> (<?php echo ucfirst($role); ?>)</span>
                <a href="logout.php" class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Dummy Cards -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800">Cemetery & Burial Management</h3>
                    <p class="text-gray-600 mt-2">View or update your personal information.</p>
                    <button class="mt-4 text-green-600 hover:underline">Go to Cemetery →</button>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800">Parks & Recreation</h3>
                    <p class="text-gray-600 mt-2">Submit concerns or suggestions.</p>
                    <button class="mt-4 text-green-600 hover:underline">Go to Parks →</button>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-800">Facility Management System</h3>
                    <p class="text-gray-600 mt-2">Check alerts and updates.</p>
                    <button class="mt-4 text-green-600 hover:underline">Go to Facilities →</button>
                </div>
            </div>

            <div class="mt-10 p-6 bg-blue-50 border border-blue-200 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800">Logged-in User Info (from central DB)</h3>
                <ul class="mt-4 space-y-2 text-gray-700">
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
                    <li><strong>Full Name:</strong> <?php echo htmlspecialchars($full_name); ?></li>
                    <li><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></li>
                    <li><strong>Session Started:</strong> <?php echo date('F j, Y g:i A'); ?></li>
                </ul>
            </div>
        </div>
    </div>

</body>
</html>