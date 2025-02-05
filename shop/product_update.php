<!DOCTYPE HTML>
<html>

<?php
include 'menu.php';
include 'validation.php';
?>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Product</h1>
        </div>

        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        include 'config/database.php';

        try {
            $query = "SELECT id, name, description, price, product_cat, manufacture_date, expired_date FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $product_cat = $row['product_cat'];
            $manufacture_date = $row['manufacture_date'];
            $expired_date = $row['expired_date'];
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
                $query = "UPDATE products
                SET name=:name, description=:description, price=:price, product_cat=:product_cat, 
                    manufacture_date=:manufacture_date, expired_date=:expired_date
                            WHERE id = :id";
                // prepare query for excecution
                $stmt = $con->prepare($query);
                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $product_cat = htmlspecialchars(strip_tags($_POST['product_cat']));
                $manufacture_date = htmlspecialchars(strip_tags($_POST['manufacture_date']));
                $expired_date = htmlspecialchars(strip_tags($_POST['expired_date']));
                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':product_cat', $product_cat);
                $stmt->bindParam(':manufacture_date', $manufacture_date);
                $stmt->bindParam(':expired_date', $expired_date);
                $stmt->bindParam(':id', $id);
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo $name; ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo $description; ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo $price; ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Product Category</td>
                    <td>
                        <select name='product_cat' class='form-control'>
                            <?php
                            $cat_query = "SELECT product_cat_id, product_cat_name FROM product_cat";
                            $cat_stmt = $con->prepare($cat_query);
                            $cat_stmt->execute();

                            while ($cat_row = $cat_stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($cat_row['product_cat_id'] == $product_cat) ? "selected" : "";
                                echo "<option value='{$cat_row['product_cat_id']}' {$selected}>{$cat_row['product_cat_name']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Manufactured Date</td>
                    <td><input type='date' name='manufacture_date' value="<?php echo $manufacture_date; ?>"
                            class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td>Expiratory Date</td>
                    <td><input type='date' name='expired_date' value="<?php echo $expired_date; ?>"
                            class='form-control' />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='product_listing.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>


    </div>
    <!-- end .container -->
</body>

</html>