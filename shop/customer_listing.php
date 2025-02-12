<!DOCTYPE HTML>
<html>
<?php
include 'menu.php';
include 'validation.php';
include 'config/database.php';
?>

<head>
    <title>Customer Listings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Customer Listings</h1>
        </div>

        <a href='customer_create.php' class='btn btn-primary m-b-1em'>Create New Customer</a>

        <form action="" class="d-flex my-3" method="get">
            <input class="form-control me-2" type="text" placeholder="Search by Username, First Name, or Last Name"
                name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">

            <select class="form-select me-2" name="sort_by">
                <option value="username" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'username') ? 'selected' : '' ?>>Sort by Username</option>
                <option value="first_name" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'first_name') ? 'selected' : '' ?>>Sort by First Name</option>
                <option value="last_name" <?= (isset($_GET['sort_by']) && $_GET['sort_by'] == 'last_name') ? 'selected' : '' ?>>Sort by Last Name</option>
            </select>

            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <?php
        $query = "SELECT username, password, first_name, last_name, gender, dateofbirth, registration_date, stat FROM customer WHERE 1";

        if (!empty($_GET['search'])) {
            $search = "%" . $_GET['search'] . "%";
            $query .= " AND (username LIKE :search OR first_name LIKE :search OR last_name LIKE :search)";
        }

        $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'username';
        $query .= " ORDER BY $sortBy ASC";

        $stmt = $con->prepare($query);

        if (!empty($_GET['search'])) {
            $stmt->bindParam(':search', $search);
        }

        $stmt->execute();
        $num = $stmt->rowCount();
        ?>


        <?php if ($num > 0): ?>
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['password']) ?></td>
                        <td><?= htmlspecialchars($row['first_name']) ?></td>
                        <td><?= htmlspecialchars($row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['dateofbirth']) ?></td>
                        <td><?= htmlspecialchars($row['registration_date']) ?></td>
                        <td>
                            <a href='read_one.php?id=<?= $row['username'] ?>' class='btn btn-info'>Read</a>
                            <a href='customer_update.php?username=<?= $row['username'] ?>' class='btn btn-primary'>Edit</a>
                            <a href='#' onclick='delete_customer("<?= $row['username'] ?>");' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <div class='alert alert-danger'>No customers found.</div>
        <?php endif; ?>
    </div>

    <script>
        function delete_customer(username) {
            if (confirm('Are you sure you want to delete this customer?')) {
                window.location = 'customer_delete.php?username=' + username;
            }
        }
    </script>
</body>

</html>