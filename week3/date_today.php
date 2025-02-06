<!DOCTYPE html>
<html>

<head>
    <title>Date Select Menu</title>
</head>

<body>
    <form>
        <select name="day">
            <?php
            $currentDay = date("j");
            for ($day = 1; $day <= 31; $day++) {
                echo "<option value='$day'" . ($day == $currentDay ? " selected" : "") . ">$day</option>";
            }
            ?>
        </select>

        <select name="month">
            <?php
            $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            $currentMonth = date("n");
            foreach ($months as $index => $month) {
                $monthValue = $index + 1;
                echo "<option value='$monthValue'" . ($monthValue == $currentMonth ? " selected" : "") . ">$month</option>";
            }
            ?>
        </select>

        <select name="year">
            <?php
            $currentYear = date("Y");
            for ($year = 1900; $year <= $currentYear; $year++) {
                echo "<option value='$year'" . ($year == $currentYear ? " selected" : "") . ">$year</option>";
            }
            ?>
        </select>
    </form>
</body>

</html>