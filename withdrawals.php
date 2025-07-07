
<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "fastwin"); // Change credentials if needed
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"], $_POST["wid"])) {
    $wid = (int)$_POST["wid"];
    $action = $_POST["action"] === "approve" ? "approved" : "rejected";
    $conn->query("UPDATE withdrawals SET status = '$action' WHERE id = $wid");
}

$result = $conn->query("SELECT id, user_id, amount, status FROM withdrawals ORDER BY id DESC");
echo "<h2>Withdrawals</h2>";
echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>User ID</th><th>Amount</th><th>Status</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>₹{$row['amount']}</td><td>{$row['status']}</td>";
    echo "<td>
        <form method='post' style='display:inline;'>
            <input type='hidden' name='wid' value='{$row['id']}'>
            <button name='action' value='approve'>Approve</button>
            <button name='action' value='reject'>Reject</button>
        </form>
    </td></tr>";
}
echo "</table>";
?>
