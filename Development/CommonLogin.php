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
$username="CAM";
$password="zen123";
setcookie('access_level','standarduser');

function displayAccessLevelInformation($accessLevel){
    if($accessLevel =="standarduser"){
        echo"<p>You are currently logged in as a standard user</p>";
    }
    elseif($accessLevel =="root"){
        echo"<p>You are currently logged in as a root user</p>";
        echo"<p>You now have access to add bugs and comments</p>";
    }
}


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
