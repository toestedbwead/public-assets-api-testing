<?php
// index.php - Minimal Dashboard
require_once 'includes/config.php';
$conn = getDBConnection();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Public Assets - Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 1000px; margin: 0 auto; }
        h1 { color: #4CAF50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn { 
            padding: 6px 12px; 
            background: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn.create { background: #FDA811; }
        .status { 
            padding: 4px 8px; 
            border-radius: 4px; 
            font-size: 12px; 
            font-weight: bold; 
        }
        .pending { background: #ffeb3b; color: #333; }
        .sent { background: #4CAF50; color: white; }
        .failed { background: #f44336; color: white; }
    </style>
</head>
<body>
    <h1>Public Assets System</h1>
    <a href="create_announcement.php" class="btn create">+ Create Announcement</a>
    
    <h2>Announcements</h2>
    
    <?php
    $sql = "SELECT * FROM announcements ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0):
    ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Created</th>
                <th>Status</th>
                <th>Push</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><strong><?= htmlspecialchars($row['title']) ?></strong></td>
                <td><?= $row['category'] ?></td>
                <td><?= date('Y-m-d', strtotime($row['created_at'])) ?></td>
                <td><?= ucfirst($row['status']) ?></td>
                <td>
                    <?php if ($row['push_status']): ?>
                    <span class="status <?= $row['push_status'] ?>"><?= $row['push_status'] ?></span>
                    <?php else: ?>
                    <span class="status pending">pending</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="btn" onclick="pushToCitizen(<?= $row['id'] ?>)">Push</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No announcements yet. <a href="create_announcement.php">Create one</a>.</p>
    <?php endif; ?>
    
    <script>
    function pushToCitizen(id) {
        alert('Will push announcement ID ' + id + ' to Citizen system.');
        // API integration will go here
    }
    </script>
</body>
</html>
<?php $conn->close(); ?>