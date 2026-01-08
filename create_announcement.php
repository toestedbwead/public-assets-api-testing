<?php
require_once 'includes/config.php';
$conn = getDBConnection();

$message = ''; // To show success/error messages

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category = $conn->real_escape_string($_POST['category']);
    
    // Save to OUR database first
    $sql = "INSERT INTO announcements (title, content, category, status) 
            VALUES ('$title', '$content', '$category', 'published')";
    
    if ($conn->query($sql) === TRUE) {
        $our_announcement_id = $conn->insert_id;
        $message = "Announcement saved to our database (ID: $our_announcement_id).";
        
        // In the NEXT STEP, we will add the API call to Citizen system here
        // $api_result = pushToCitizenSystem($title, $content, $category, $our_announcement_id);
        
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Public Assets - Create Announcement</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 800px; margin: auto; }
        .header { background: #4CAF50; color: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; }
        .message { padding: 15px; margin: 20px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea { height: 150px; }
        button {
            background: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background: #45a049; }
        .back-link { display: inline-block; margin-top: 20px; color: #4CAF50; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Public Assets System</h1>
        <p>Create a new public announcement</p>
    </div>

    <?php if (!empty($message)): ?>
        <div class="message <?php echo (strpos($message, '✅') !== false) ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="title">Announcement Title</label>
            <input type="text" id="title" name="title" required placeholder="e.g., Park Closure for Maintenance">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="">-- Select Category --</option>
                <option value="park">Park & Recreation</option>
                <option value="facility">Facility</option>
                <option value="water">Water Supply</option>
                <option value="cemetery">Cemetery</option>
                <option value="general">General Announcement</option>
            </select>
        </div>

        <div class="form-group">
            <label for="content">Announcement Content</label>
            <textarea id="content" name="content" required placeholder="Provide full details of the announcement..."></textarea>
        </div>

        <button type="submit">Save Announcement</button>
    </form>

    <a class="back-link" href="index.php">← Back to Dashboard</a>

</body>
</html>

<?php
$conn->close();
?>