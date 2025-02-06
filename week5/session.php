<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null;
}

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'set') {
        $_SESSION['username'] = "StudentUser";
        $_SESSION['email'] = "student@example.com";
        $message = "Session variables have been set.";
    } elseif ($_GET['action'] === 'get') {
        if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
            $username = htmlspecialchars($_SESSION['username']);
            $email = htmlspecialchars($_SESSION['email']);
            $message = "Session data retrieved successfully.";
        } else {
            $message = "No session data found. Set the session variables first.";
        }
    } elseif ($_GET['action'] === 'destroy') {
        session_destroy();
        $_SESSION = [];
        header("Location: login.php");
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Session Management</title>
</head>

<body>
    <h1>PHP Session Management</h1>

    <?php if (isset($message)): ?>
        <p><strong><?php echo $message; ?></strong></p>
    <?php endif; ?>

    <?php if (isset($username) && isset($email)): ?>
        <h2>Retrieved Session Data</h2>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
    <?php endif; ?>

    <h2>Actions</h2>
    <ul>
        <li><a href="?action=set">Set Session Variables</a></li>
        <li><a href="?action=get">Get Session Variables</a></li>
        <li><a href="?action=destroy">Destroy Session</a></li>
    </ul>
</body>

</html>