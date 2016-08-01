<?php
/** =====================================================================================*/
/**
 * PURPOSE : This is the Login Page - It allows users to log in
 * SECURITY : This page is available to all users but only those who are verified by the
 *            admin can log in once on this page.
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
?>
<!--=====================================================================================-->

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

<!-- Bring in the common header script -->
<?php include 'CommonHeader.php';?>

<!-- Start the session -->
<?php
session_start();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($db, 'SELECT * FROM bug_userprofile WHERE Usr_User="'.$username.'" AND Usr_Password="'.$password.'"');
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result)==1){
     if ($row['Usr_IsVerified'] == '1') {
         $_SESSION['username'] = $username;
         $_SESSION['isadmin'] = $row['Usr_IsAdministrator'];
         $_SESSION['isverified'] = $row['Usr_IsVerified'];
         header('Location: homepage.php');
     }
        else echo 'You are not yet verified - please contact the administrator at bigadmin@splat.com';
    }
    else
        echo "<br>";
        echo "Username or Password incorrect. Please correct and try again or if not registered please press Register button above.";
        echo "<br>";
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

