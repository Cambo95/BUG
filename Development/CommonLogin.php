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
<body>

<form action='validatelogin.php' method="POST">
    <label>Username</label><input type="text" name="username">
    <label>Password</label><input type="password" name="password">
    <input type="submit" name="submit">
</form>

</body>
</html>

