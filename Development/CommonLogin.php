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
<?php include 'CommonHeader.php';?>
<?php
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($db, 'SELECT * FROM bug_userprofile WHERE Usr_User="'.$username.'" AND Usr_Password="'.$password.'"');
    $row = mysqli_fetch_object($result);
    if(mysqli_num_rows($result)==1){
        $_SESSION['username']= $username;
        $_SESSION['isadmin'] = $row['Usr_IsAdministrator'];
        $_SESSION['isverified'] = $row['Usr_IsVerified'];
        header('Location: homepage.php');
        vardump($_SESSION);
    }
    else
        echo "Account is invalid";
}
?>
<style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
</style>

<form action='CommonLogin.php?action=login' method="POST">
    <label>Username</label><input type="text" name="username">
    <label>Password</label><input type="password" name="password">
    <input type="submit" name="submit">
</form>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>

