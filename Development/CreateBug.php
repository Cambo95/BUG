<?php
/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 13/07/2016
 * Time: 16:25
 */

$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);

?>

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
<body>
<?php include 'CommonHeader.php';?>

<form>
    Username:<br>
    <input type ="text" name="Bug Title">
    <br>
    Password:<br>
    <input type="text" name="Description">
    <br>
    <input type ="submit" value ="Create Bug">
</form>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>