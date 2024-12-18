<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Customer</h1>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->
        <?php
        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // posted values
                $username = $_POST['username'];
                $password = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $gender = $_POST['gender'];
                $dateofbirth = $_POST['dateofbirth'];
                var_dump($_POST);


                $errors = [];

                if (empty($username)) {
                    $errors[] = "Username is required.";
                }
                if (empty($password)) {
                    $errors[] = "Password is required.";
                }
                if (empty($firstname)) {
                    $errors[] = "First Name is required.";
                }
                if (empty($lastname)) {
                    $errors[] = "Last Name is required.";
                }
                if (empty($gender)) {
                    $errors[] = "Gender is required.";
                }
                if (empty($dateofbirth)) {
                    $errors[] = "Date of Birth is required.";
                }

                // If there are errors, display them
                if (!empty($errors)) {
                    echo "<div class='alert alert-danger'><ul>";
                    foreach ($errors as $error) {
                        echo "<li>{$error}</li>";
                    }
                    echo "</ul></div>";
                } else {


                    // insert query
                    $query = "INSERT INTO cus SET username=:username, password=:password, firstname=:firstname, lastname=:lastname, gender=:gender, dateofbirth=:dateofbirth";
                    //$query = "INSERT INTO cus ('name') VALUES ('luis')";
        
                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    //bind the parameters
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':dateofbirth', $dateofbirth);

                    // Execute the query
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Product was added.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage() . (int) $exception->getCode());
            }
        }
        ?>


        <!-- html form here where the product information will be entered -->
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><textarea type='password' name='password' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='firstname' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='lastname' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type='radio' name='gender' value="male" />
                        <label for="male">Male</label><br>

                        <input type='radio' name='gender' value="female" />
                        <label for="female">Female</label><br>
                    </td>

                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type='date' name='dateofbirth' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>


    </div>
    <!-- end .container -->
</body>

</html>