<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: lightgreen;
            }
            .paragraph1 {
                color:orangered;
            }
            .dates {
                color:brown;
            }
            .dates2 {
                color:blue;
            }
           
        </style>
    </head>
    <body>

<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    echo "<p class=paragraph1> My name is Luis Siew! </p>";

    echo "<p class=dates>";
    echo date("d:M:Y");
    echo "</p>";

    echo "<p class=dates2>";
    echo date("g:a");
    echo "</p>";
?>
    
    </body>
</html>