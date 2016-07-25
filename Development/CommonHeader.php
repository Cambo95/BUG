

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body>
    <header class="w3-container w3-teal">
        <H1> SPLAT! Bug Catcher</H1>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/development/homepage.php">Home</a></li>
        </ul>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/development/Bug_Userprofile_Display.php">Profile</a></li>
        </ul>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/development/CommonLogin.php">Login</a></li>
        </ul>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/development/registration.php">Register</a></li>
        </ul>
    </header>
</body>
</html>



    <li class='active' style='float:right; color: white; border: none;'>
<?php
session_start();
var_dump($_SESSION);
if ($_SESSION["username"]== ''){
    echo '<a href="CommonLogin.php"><span>Not Signed in</span></a></li>';
    echo ' point 1 ';
}
else{
    echo '<a href="Logout.php"><span>Logout</span></a></li>';
    echo 'point 2  ';
}
if ($_SESSION["isadmin"]== '1'){
    echo '<a href="AdminPage.php"><span>Administrative Page</span></a></li>';
    echo ' point3 ';
}
if ($_SESSION["isverified"]== '1'){
    echo '<a href="CreateBug.php"><span>Add a bug</span></a></li>';
    echo 'point 4  ';
}
?>