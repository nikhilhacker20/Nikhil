
<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "fastwin"); // Change credentials as needed
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bonus_amount"], $_POST["user_id"])) {
    $bonus = (int)$_POST["bonus_amount"];
    $user_id = (int)$_POST["user_id"];
    $conn->query("UPDATE users SET balance = balance + $bonus WHERE id = $user_id");
    echo "<p style='color:green;'>Bonus ₹$bonus added to user ID $user_id.</p>";
}

$result = $conn->query("SELECT id, username, balance FROM users");
echo "<h2>Users</h2>";
echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>Username</th><th>Balance</th><th>Give Bonus</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['username']}</td><td>₹{$row['balance']}</td>";
    echo "<td>
        <form method='post' style='display:inline;'>
            <input type='hidden' name='user_id' value='{$row['id']}'>
            <input type='number' name='bonus_amount' placeholder='₹' required>
            <button type='submit'>Give</button>
        </form>
    </td></tr>";
}
echo "</table>";
?>
