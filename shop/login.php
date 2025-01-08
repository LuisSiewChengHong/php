<!DOCTYPE html>
<html>

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
            <img class="mb-4" src="brandLogo.webp" alt="" width="100" height="80">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                    required>
                <label for="email">Email/Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                    required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
        </form>
    </main>
</body>

</html>

<?php
include 'config/database.php';
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    if (empty($email) && empty($username)) {
        echo "<p style='color:red;'>Please enter either an email or a username.</p>";
    } else {
        echo "<p style='color:green;'>Form submitted successfully.</p>";
    }
}
?>