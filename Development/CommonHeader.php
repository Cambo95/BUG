<?php session_start();?>
<li class='active' style='float:right; color: white; padding: 14px 20px; margin 8px 0; border: none;'>
    <?php
    echo "Just before if statement";
    echo $_SESSION["username"];
    var_dump($_SESSION);
    if ($_SESSION["username"]== ''){
        echo $_SESSION["username"];
        echo '<a href="HomePage.php"><span>Not Signed in</span></a></li>';
    }
    else{
        echo '<a href="HomePage.php"><span>Logout</span></a></li>';  
    }
    ?>
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