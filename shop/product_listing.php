<!DOCTYPE HTML>
<html>
<?php
include 'menu.php';
include 'validation.php';
?>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Product Listings</h1>
        </div>

        <?php
        // include database connection
        include 'config/database.php';

        $query = "SELECT id, name, description, price, product_cat_name, created, modified, manufacture_date, expired_date FROM products
        INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id ORDER BY id ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        if ($_POST) {
            $name = $_POST['name'];

            $query = "SELECT id, name, description, price, product_cat_name, created, modified, manufacture_date, expired_date FROM products
        INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id WHERE `name` LIKE '" . $_POST['name'] . "' ORDER BY id ASC";
            $stmt = $con->prepare($query);
            $stmt->execute();
        }
        if ($_POST) {
            $name = $_POST['name'];

            $query = "SELECT id, name, description, price, product_cat_name, created, modified, manufacture_date, expired_date FROM products
        INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id WHERE product_cat_name LIKE '" . $_POST['name'] . "' ORDER BY id ASC";
            $stmt = $con->prepare($query);
            $stmt->execute();
        }


        // delete message prompt will be herecat = product_cat.product
        
        // select all data
        
        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<a href='product_create.php' class='btn btn-primary m-b-1em'>Create New Product</a>";
        ?>

        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' class="d-flex" role="search" method="post">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="name">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <?php

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>";//start table
        
            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Category";
            echo "<th>Price</th>";
            echo "<th>Manufacture Date</th>";
            echo "<th>Expiratory Date</th>";
            echo "</tr>";

            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>{$product_cat_name}</td>";
                echo "<td>{$price}</td>";
                echo "<td>{$manufacture_date}</td>";
                echo "<td>{$expired_date}</td>";
                echo "<td>";
                // read one record
                echo "<a href='product_details.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='product_update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }


            // end table
            echo "</table>";



        }
        // if no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>



    </div> <!-- end .container -->

    <!-- confirm delete record will be here -->

</body>

</html>