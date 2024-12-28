<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: lightcoral;
            }
            .Rand1 {
                color: green;
                font-style:italic;
            }
            .Rand2 {
                font-style:italic;
                color: blue;
            }
            .randSum {
                font-style:bold;
                color: red;
            }
            .randMul {
                font-style: bold;
                font-style:italic;
                color: black;
            }
        </style>
    </head>
    <body>


<?php
$randomNumber1 = rand(100,200);
$randomNumber2 = rand(100,200);
$randomSum = $randomNumber1 + $randomNumber2;
$randomMultiple = $randomNumber1 * $randomNumber2;

echo "<p class=Rand1> First Random Number = ";
echo $randomNumber1;
echo "</p>";

echo "<p class=Rand2> Second Random Number = ";
echo $randomNumber2;
echo "</p>";

echo "<p class=randSum> Sum of both Random Numbers = ";
echo $randomSum;
echo "</p>";

echo "<p class=randMul> Multiple of both Random Numbers = ";
echo $randomMultiple;
echo "</p>";

?>
    
    </body>
</html>