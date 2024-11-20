<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
<body>
    <?php

$randomNumber = rand(1,23);

echo $randomNumber, "\n";


if($randomNumber >= 5 && $randomNumber <= 11)
{
    echo "Good Morning!";
}
else if($randomNumber >= 12 && $randomNumber <= 17)
{
    echo "Good Afternoon!";
}
else if($randomNumber >= 18 && $randomNumber <= 21)
{
    echo "Good Evening!";
}
else
{
    echo "Good Night!";
}




    ?>
</body>
</html>