
<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["qr"])) {
    move_uploaded_file($_FILES["qr"]["tmp_name"], "qr.png");
    $msg = "QR code updated successfully.";
}
?>
<h2>Change QR Code</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="qr" required><br><br>
    <button type="submit">Upload</button>
</form>
<?php if (isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
<img src="qr.png" alt="Current QR" width="200">
