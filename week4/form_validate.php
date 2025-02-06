<!DOCTYPE html>
<html>

<head>
    <title>Form Validation Handling</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $name = $email = $age = "";
    $nameError = $emailError = $ageError = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $age = isset($_POST['age']) ? trim($_POST['age']) : '';

        if (empty($name)) {
            $nameError = "Please enter your name.";
        }

        if (empty($email)) {
            $emailError = "Please enter your email.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format.";
        }

        if (empty($age)) {
            $ageError = "Please enter your age.";
        } elseif (!is_numeric($age) || $age < 18 || $age > 100) {
            $ageError = "Age must be a numeric value between 18 and 100.";
        }

        if (empty($nameError) && empty($emailError) && empty($ageError)) {
            echo "<h1>Form Submitted Successfully</h1>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Age:</strong> $age</p>";
            exit;
        }
    }
    ?>

    <h1>Enter Your Details</h1>

    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <span class="error"><?php echo $nameError; ?></span>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span class="error"><?php echo $emailError; ?></span>
        <br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <span class="error"><?php echo $ageError; ?></span>
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>