<!DOCTYPE html>
<html>
    <head>
        <style>

        </style>
    </head>
    <body>

<form action = "<?php echo $_SERVER["PHP_SELF"]; ?> " method = "get">
    <label for = "countries">Country:</label>
    <select name = "countries">
    <option value = "">=Please select=</option>
        <option value = "Malaysia">Malaysia</option>
        <option value = "Indonesia">Indonesia</option>
        <option value = "Japan">Japan</option>
        <option value = "Mexico">Mexico</option>
        <option value = "Malawi">Malawi</option>
        <option value = "Mali">Mali</option>
        <option value = "Brazil">Brazil</option>
        <option value = "Nigeria">Nigeria</option>
        <option value = "Norway">Norway</option>
        <option value = "Colombia">Colombia</option>
    </select>
    <br>

<label for = "day">Day:</label>
<select name = "day">
<?php 
for($i = 1; $i <= 30; $i++)
{
    echo '<option value = "' . $i . '">' . $i . "</option>";
}
?>
</select>



<label for = "month">Month:</label>
<select name = "month">
<?php 
for($i = 1; $i <= 12; $i++)
{
    echo '<option value = "' . $i . '">' . $i . "</option>";
}
?> 
</select>



<label for = "year">Year:</label>
<select name = "year">
<?php 
for($i = 2000; $i <= 2024; $i++)
{
    echo '<option value = "' . $i . '">' . $i . "</option>";
}
?>
</select>
<br>



    <label for = "radio">Female</label>
    <input type = "radio" name = "gender"    
    <?php 
    if(isset($gender) && $gender == "female") 
    {
        echo "checked";
    }
    ?>
    value = "female">


    
    <label for = "radio">Male</label>
    <input type = "radio" name = "gender"
    <?php 
    if(isset($gender) && $gender == "male") 
    {
        echo "checked";
    }
    ?>
    value = "male">
    




<br><br>
<input type = "submit">
</form>



Your country is: <?php echo isset($_GET["countries"]) ? $_GET["countries"] : "(=Please Select A Country=)"; ?> <br>
Your DOB is: <?php echo $_GET["day"] . "/" . $_GET["month"] . "/" . $_GET["year"]; ?> <br>
Your Gender: <?php echo isset($_GET["gender"]) ? $_GET["gender"] : "(=Please Select Gender=)"; ?>




    </body>
</html>