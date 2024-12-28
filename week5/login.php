<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
<body>


<form action = "<?php echo $_SERVER["PHP_SELF"]; ?> " method = "post">
    <label for = "username">Username</label>
    <input type = "text" name = "username" required/>
    <label for = "password">Password</label>
    <input type = "password" name = "password" required/>
<input type="submit">
</form>

<?php
if (!empty($_POST))
{
    if($_POST["username"]=="admin" && $_POST["password"] == "1234")
    {
        echo "Login Successful, Welcome!";
    }
    else
    {
        echo "Invalid Credentials, Please Login Again!";
    }
}
?>


</body>
</html>