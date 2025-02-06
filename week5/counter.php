<?php
session_start();

if (!isset($_SESSION['page_views'])) {
    $_SESSION['page_views'] = 1;
} else {
    $_SESSION['page_views']++;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page View Counter</title>
</head>

<body>
    <h1><?php echo "You have visited this page " . $_SESSION['page_views'] . " times."; ?></h1>
</body>

</html>