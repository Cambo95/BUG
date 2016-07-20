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
session_start();
$_SESSION['Username']="CAM";

print $_SESSION['Username'];

?>

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

<form action="" method="post">
    <label>Username</label><input type=“text” name=“Username”>
    <label>Password</label><input type=“password” name=“Password”>
    <input type="submit" value="Login">
</form>
<?php 
    if(isset($_POST['Login']));{
    echo "Cam pressed Login";
}
?>
</body>
</html>

