<?php session_start();?>

    <!DOCTYPE html>
    <html lang="en">
    <title>SPLAT! Bug Catcher</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <body>
    <header class="w3-container w3-teal">
        <H1> SPLAT! Bug Catcher</H1>
    </header>
    </body>
    </html>
    <!-- PURPOSE : This is the Header that sits on all pages
                   it only displays the links that specific 
                   users are allowed to see. This is done by 
                   using If statements and Session -->

    <!-- Admin page link is only available to those who have admin rights -->
    <!-- Add a bug page and Profile are only available to those who are verified and logged in -->
    <!-- Login link and a Registration link are available to those not logged in or registered -->
    <!-- A Home link and an Author Search link are available to everyone -->
    <!-- Logout appears to those who are logged in -->

<?php
    echo '<a href="HomePage.php"><span>Home<br></span></a></li>';

if ($_SESSION["isadmin"]== '1'){
    echo '<a href="AdminPage.php"><span>Administrative Page<br></span></a></li>';
}
if ($_SESSION["isverified"]== '1'){
    echo '<a href="CreateBug.php"><span>Add a bug<br></span></a></li>';
    echo '<a href="Bug_Userprofile_Display.php?paramuser="><span>Profile<br></span></a></li>';
}
if ($_SESSION["username"]== ''){
    echo '<a href="CommonLogin.php"><span>Login<br></span></a></li>';
    echo '<a href="Registration.php"><span>Register<br></span></a></li>';
}
else{
    echo '<a href="Logout.php"><span>Logout<br></span></a></li>';
}
    echo '<a href="AuthorSearch.php"><span>Author Search<br></span></a></li>';
?>