<?php
session_start();
require 'session.php';

if (!isset($_SESSION['user']) || $_SESSION['user'] === null) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>