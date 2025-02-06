<!DOCTYPE html>
<html>

<head>
    <title>Form Handling</title>
</head>

<body>
    <?php
    $name = $email = $age = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] === "GET" && !empty($_GET)) {
        $name = isset($_GET['name']) ? trim($_GET['name']) : '';
        $email = isset($_GET['email']) ? trim($_GET['email']) : '';
        $age = isset($_GET['age']) ? trim($_GET['age']) : '';

        if (empty($name)) {
            $errorMessage = "Please enter your name.";
        } elseif (empty($email)) {
            $errorMessage = "Please enter your email.";
        } elseif (empty($age)) {
            $errorMessage = "Please enter your age.";
        } else {
            echo "<h1>Form Submitted Successfully</h1>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Age:</strong> $age</p>";
            exit;
        }
    }
    ?>

    <h1>Enter Your Details</h1>

    <?php
    if (!empty($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    ?>

    <form method="GET" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>