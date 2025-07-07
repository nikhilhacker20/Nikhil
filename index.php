
<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; padding: 20px; }
        .card { padding: 20px; background: #f0f0f0; margin: 10px 0; border-radius: 8px; }
    </style>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <div class="card">Total Users: [dynamic]</div>
    <div class="card">Total Withdrawals: [dynamic]</div>
    <a href="users.php">Manage Users</a> | 
    <a href="withdrawals.php">Withdrawals</a> | 
    <a href="qr.php">Change QR Code</a> |
    <a href="logout.php">Logout</a>
</body>
</html>
