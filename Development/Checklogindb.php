

<!-- ============================================================================== -->
<!-- Set up the Tab name -->
<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>
<!-- ============================================================================== --> 

<?php

/** =====================================================================================*/
/**
 * Created by PhpStorm.
 * User: Cambo
 *
 * PURPOSE : This is the CheckLogin script - it is called from login page and
 *           its purpose is to check the user profile and password are valid in the
 *           database.
 * SECURITY : This page is only available to Users who are tagged as "UserIsAdmin"
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);

/** Retrieve the username */
$username = $_POST['username'];
/** Retrieve the password */
$password = $_POST['password'];
echo $username;
echo $password;
?>

<?php


    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    $sql = "SELECT * FROM bug_userprofile WHERE Usr_User = '$username' and Usr_Password = '$password'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
        echo 'Logged in';
    }else {
        $error = "Your Login Name or Password is invalid";
    }
?>
</body>
</html>