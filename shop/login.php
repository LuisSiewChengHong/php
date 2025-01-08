<!DOCTYPE html>
<html>

<?php
include 'config/database.php';

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

}
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .btn-primary {
            background-color: crimson;
        }
    </style>
</head>


<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <img class="mb-4" src="brandLogo.webp" alt="" width="150" height="120">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email">Email/Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <?php

            if (!empty($errors)) {
                echo "<div class='alert alert-danger'><ul>";
                foreach ($errors as $error) {
                    echo "<li>{$error}</li>";
                }
                echo "</ul></div>";
            } else {
                try {
                    $query = "SELECT password, status FROM customer
                    WHERE email = 'userinput' OR username = 'userinput'";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    $num = $stmt->rowCount();

                    /*if ($email_error != null) {
                        ?>
                        <style>
                            .email-error {
                                display: block
                            }
                        </style> <?php
                    }
                    if ($password_error != null) {
                        ?>
                        <style>
                            .password-error {
                                display: block
                            }
                        </style> <?php
                    }
                    if ($password_error != null) {
                        ?>
                        <style>
                            .password-error {
                                display: block
                            }
                        </style>
                        <?php
                    }*/

                    if ($num > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $stored_password = $row['password'];
                        $status = $row['status'];

                        if (password_verify($password, $stored_password)) {
                            if ($status == 'active') {
                                echo "<p style='color:green;'>Login successful. Welcome!</p>";
                                header("location: customer_details.php");
                            } else {
                                echo "<p style='color:orange;'>Your account is inactive. Please contact support.</p>";
                            }
                        } else {
                            echo "<p style='color:red;'>Incorrect password. Please try again.</p>";
                        }
                    } else {
                        echo "<p style='color:red;'>No account found with that email.</p>";
                    }
                } catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
            ?>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </main>
</body>

</html>