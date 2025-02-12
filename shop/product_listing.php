<!DOCTYPE HTML>
<html>
<?php
include 'menu.php';
include 'validation.php';
include 'config/database.php';
?>

<head>
    <title>Product Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Product Listings</h1>
        </div>

        <a href='product_create.php' class='btn btn-primary m-b-1em'>Create New Product</a>

        <form action="" class="d-flex my-3" role="search" method="get">
            <input class="form-control me-2" type="text" placeholder="Search Product" name="search"
                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

            <select class="form-select me-2" name="category">
                <option value="">All Categories</option>
                <?php
                $catQuery = "SELECT product_cat_id, product_cat_name FROM product_cat";
                $catStmt = $con->prepare($catQuery);
                $catStmt->execute();
                while ($catRow = $catStmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = isset($_GET['category']) && $_GET['category'] == $catRow['product_cat_id'] ? 'selected' : '';
                    echo "<option value='{$catRow['product_cat_id']}' {$selected}>{$catRow['product_cat_name']}</option>";
                }
                ?>
            </select>

            <select class="form-select me-2" name="sort">
                <option value="ASC" <?= (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : '' ?>>Sort A-Z
                </option>
                <option value="DESC" <?= (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : '' ?>>Sort Z-A
                </option>
            </select>

            <button class="btn btn-outline-success" type="submit">Filter</button>
        </form>

        <?php
        $query = "SELECT products.id, products.name, products.description, products.price, product_cat.product_cat_name, products.manufacture_date, products.expired_date 
                  FROM products
                  INNER JOIN product_cat ON products.product_cat = product_cat.product_cat_id 
                  WHERE 1 ";

        if (!empty($_GET['search'])) {
            $search = "%{$_GET['search']}%";
            $query .= " AND (products.name LIKE :search OR product_cat.product_cat_name LIKE :search) ";
        }

        if (!empty($_GET['category'])) {
            $query .= " AND products.product_cat = :category ";
        }

        $sortOrder = isset($_GET['sort']) && ($_GET['sort'] === 'DESC') ? 'DESC' : 'ASC';
        $query .= " ORDER BY products.name $sortOrder";

        $stmt = $con->prepare($query);

        if (!empty($_GET['search'])) {
            $stmt->bindParam(':search', $search);
        }

        if (!empty($_GET['category'])) {
            $stmt->bindParam(':category', $_GET['category']);
        }

        $stmt->execute();
        $num = $stmt->rowCount();

        $countQuery = "SELECT product_cat.product_cat_name, COUNT(products.id) AS product_count 
                       FROM product_cat 
                       LEFT JOIN products ON product_cat.product_cat_id = products.product_cat 
                       GROUP BY product_cat.product_cat_name";
        $countStmt = $con->prepare($countQuery);
        $countStmt->execute();
        ?>

        <div class="mb-3">
            <h5>Product Count by Category</h5>
            <ul class="list-group">
                <?php while ($countRow = $countStmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($countRow['product_cat_name']) ?>
                        <span class="badge bg-primary rounded-pill"><?= $countRow['product_count'] ?></span>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <?php if ($num > 0): ?>
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Manufacture Date</th>
                    <th>Expiry Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['product_cat_name']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['manufacture_date']) ?></td>
                        <td><?= htmlspecialchars($row['expired_date']) ?></td>
                        <td>
                            <a href='product_details.php?id=<?= $row['id'] ?>' class='btn btn-info'>Read</a>
                            <a href='product_update.php?id=<?= $row['id'] ?>' class='btn btn-primary'>Edit</a>
                            <a href='#' onclick='delete_product(<?= $row['id'] ?>);' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <div class='alert alert-danger'>No records found.</div>
        <?php endif; ?>
    </div>

    <script>
        function delete_product(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location = 'product_delete.php?id=' + id;
            }
        }
    </script>
</body>

</html>