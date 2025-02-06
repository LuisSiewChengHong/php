<!DOCTYPE html>
<html>

<head>
    <title>Select Day, Month, Year</title>
</head>

<body>
    <form action="" method="post">
        <label for="day">Day:</label>
        <select id="day" name="day">
            <?php
            for ($day = 1; $day <= 31; $day++) {
                echo "<option value='$day'>$day</option>";
            }
            ?>
        </select>

        <label for="month">Month:</label>
        <select id="month" name="month">
            <?php
            for ($month = 1; $month <= 12; $month++) {
                echo "<option value='$month'>$month</option>";
            }
            ?>
        </select>

        <label for="year">Year:</label>
        <select id="year" name="year">
            <?php
            $currentYear = date("Y");
            for ($year = 1900; $year <= $currentYear; $year++) {
                echo "<option value='$year'>$year</option>";
            }
            ?>
        </select>

        <button type="submit">Submit</button>
    </form>
</body>

</html>