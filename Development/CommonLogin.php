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
<?php
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($db, 'SELECT * FROM bug_userprofile WHERE Usr_User="'.$username.'" AND Usr_Password="'.$password.'"');
    if(mysqli_num_rows($result)==1){
        $_SESSION['username']= $username;
        header('Location: welcome.php');
    }
    else
        echo "Account is invalid";
}
?>
<form action='CommonLogin.php?action=login' method="POST">
    <label>Username</label><input type="text" name="username">
    <label>Password</label><input type="password" name="password">
    <input type="submit" name="submit">
</form>

</body>


</html>

