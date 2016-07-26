<?php session_start();?>

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
            <li><a href="http://1301070cameronbug.azurewebsites.net/development/registration.php">Register</a></li>
        </ul>
    </header>
    </body>
    </html>

<?php
if ($_SESSION["isadmin"]== '1'){
    echo '<a href="AdminPage.php"><span>Administrative Page<br></span></a></li>';
}
if ($_SESSION["isverified"]== '1'){
    echo '<a href="CreateBug.php"><span>Add a bug<br></span></a></li>';
    echo '<a href="Bug_Userprofile_Display.php"><span>Profile<br></span></a></li>';
}
if ($_SESSION["username"]== ''){
    echo '<a href="CommonLogin.php"><span>Login<br></span></a></li>';
}
else{
    echo '<a href="Logout.php"><span>Logout<br></span></a></li>';
}
?>