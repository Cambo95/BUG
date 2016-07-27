<?php
session_start();
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
<?php
$verifyusername=$_GET["verifyusername"];
echo "Press Verify to confirm verification of user ";
echo $verifyusername;
?>
<form action='' method="POST">
    <input type="submit" name="Verify">
</form>

<?php
$testsql ="UPDATE bug_userprofile SET Usr_IsVerified= 1 WHERE Usr_User= '$verifyusername'";
echo $testsql;
if(isset($_POST['submit'])) {
$UserIsAdmin =  $_SESSION['isadmin'];
if ($UserIsAdmin !== "1"){
echo "You are not an admin. You do not have permission to verify accounts.";}
    else{
        $result = mysqli_query($db, $testsql);
        header("Location: AdminPage.php");
    }
}

?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>

    </body>
</html>    
    