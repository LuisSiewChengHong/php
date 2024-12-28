<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
<body>
    <?php

    define("username", "Luis");
    define("password", "Coolman");

    $InputUsername = "wad";
    $InputPassword = "Coolman";

    if($InputUsername == username && $InputPassword == password)
    {
        echo "Login Successful!";
    }
    else if(!($InputUsername == username && $InputPassword == password))
    {
        if($InputUsername != username)
        {
        echo "Invalid Username.";
        }
        else if($InputPassword != password)
        {
        echo "Invalid Password.";
        }
    }
    

    ?>
</body>
</html>