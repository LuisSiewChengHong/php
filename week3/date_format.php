<!DOCTYPE html>
<html>

<head>
    <title>Date and Time</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .date {
            font-size: 24px;
            font-weight: bold;
            color: #8B4513;
        }

        .time {
            font-size: 20px;
            color: #4B0082;
        }
    </style>
</head>

<body>
    <?php
    $currentDate = date("M d, Y (D)");
    $currentTime = date("H:i:s");
    ?>

    <div>
        <p class="date"><?php echo $currentDate; ?></p>
        <p class="time"><?php echo $currentTime; ?></p>
    </div>
</body>

</html>