<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Customer</h1>
        </div>

        <?php
        $name = isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record User not found.');

        include 'config/database.php';

        try {
            $query = "SELECT username, password, first_name, last_name, gender, dateofbirth, registration_date, stat FROM customer WHERE username = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $name);
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $nameofuser = $row['username'];
            $password = $row['password'];
            $oldpassword = $row['oldpassword'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $dateofbirth = $row['dateofbirth'];
            $registration_date = $row['registration_date'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>



        <?php
        // check if form was submitted
        if ($_POST) {
            try {
                // write update query
                $query = "UPDATE customer
                SET username=:username, password=:password, first_name=:first_name, last_name=:last_name, 
                    gender=:gender, dateofbirth=:dateofbirth
                            WHERE username = :username";
                // prepare query for excecution
                $stmt = $con->prepare($query);
                // posted values
                $nameofuser = htmlspecialchars(strip_tags($_POST['username']));
                $password = htmlspecialchars(strip_tags($_POST['password']));
                $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
                $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
                $gender = htmlspecialchars(strip_tags($_POST['gender']));
                $dateofbirth = htmlspecialchars(strip_tags($_POST['dateofbirth']));
                // bind the parameters
                $stmt->bindParam(':username', $nameofuser);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':dateofbirth', $dateofbirth);
                // Execute the query
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }
            // show errors
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        } ?>




        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?username={$nameofuser}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' value="<?php echo $nameofuser; ?>" class='form-control' />
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><textarea password='password' class='form-control'><?php echo $password; ?></textarea></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='first_name' value="<?php echo $first_name; ?>" class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='last_name' value="<?php echo $last_name; ?>" class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type='radio' name='gender' value="male" />
                        <label for="male">Male</label><br>

                        <input type='radio' name='gender' value="female" />
                        <label for="female">Female</label><br>
                    </td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td><input type='date' name='dateofbirth' value="<?php echo $dateofbirth; ?>"
                            class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='customer_listing.php' class='btn btn-danger'>Back to read Customers</a>
                    </td>
                </tr>
            </table>
        </form>


    </div>
</body>

</html>