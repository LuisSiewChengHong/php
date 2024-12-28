<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
<body>


<?php

$random1 = rand(1,10);

if($random1 % 2 != 0)
{
    echo "This Number is Odd = ";
    echo $random1;
}
else
{
    echo "This Number is Even = ";
    echo $random1;
}



?>

</body>
</html>