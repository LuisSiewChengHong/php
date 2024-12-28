<!DOCTYPE html>
<html>
    <head>
        <style>
            body
            {
                background-color: lightblue;
            }
            .Rand1 {
                color: lightcoral;
            }
            .Rand2 {
                color: lightcoral;
            }
        </style>
    </head>
<body>
<?php
$random1 = rand(1,10);
$random2 = rand(1,10);

if($random1 > $random2)
{
    echo "<b>", "<p>" ,$random1, "</p>", "</b>";
    echo "</p>";
    echo $random2;
}
else
{
    echo "<b>", "<p>" ,$random2, "</p>", "</b>";
    echo "</p>";
    echo $random1;
}



?>
</body>
</html>