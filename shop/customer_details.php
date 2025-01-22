<!DOCTYPE HTML>
<html>
<?php
include 'menu.php';
include 'validation.php';
?>

<head>
    <title>PDO - Read One Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Read Customer Details</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT username, password, first_name, last_name, gender, dateofbirth, registration_date, stat FROM customer WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this refer to the first question mark
            $stmt->bindParam(1, $username);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $gender = $row['gender'];
            $dateofbirth = $row['dateofbirth'];
            $registration_date = $row['registration_date'];
            $stat = $row['stat'];
        }
        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>



        <!-- HTML read one record table will be here -->

        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>username</td>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <td>firstname</td>
                <td><?php echo $first_name; ?></td>
            </tr>
            <tr>
                <td>lastname</td>
                <td><?php echo $last_name; ?></td>
            </tr>
            <tr>
                <td>gender</td>
                <td><?php echo $gender; ?></td>
            </tr>
            <tr>
                <td>date_of_birth</td>
                <td><?php echo $dateofbirth; ?></td>
            </tr>
            <tr>
                <td>registration</td>
                <td><?php echo $registration_date; ?></td>
            </tr>
            <tr>
                <td>account_status</td>
                <td><?php echo $stat; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='customer_listing.php' class='btn btn-danger'>Back to read Customers</a>
                </td>
            </tr>
        </table>


    </div> <!-- end .container -->

</body>

</html>