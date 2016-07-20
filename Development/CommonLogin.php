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
$_SESSION['var']=$val;
$_SESSION['Username']="CAM";

$_SESSION['foo'] = 'bar';
print $_SESSION['foo'];

?>

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>
<form>
    Username:<br>
    <input type ="text" name="username" placeholder="Username">
    <br>
    Password:<br>
    <input type="password" name="password" placeholder="Password">
    <br>
    <input type ="submit" value ="Login">
</form>
</body>
</html>
