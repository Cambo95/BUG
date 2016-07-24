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
    <head>
        <title>SPLAT! Bug Catcher</title>
    </head>
    <body>
<?php include 'CommonHeader.php';?>

<br><br><br>

        <form action='' method="POST">
            Name:<br>
            <input type="text" name="Name">
            <br>
            Surname:<br>
            <input type="text" name="Surname">
            <br>
            Country:<br>
            <input type="text" name="Country">
            <br>
            Bio:<br>
            <input type="text" name="Bio" maxlength="1000">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br>
            <br>
            <input type="submit" name="submit">
        </form>

<?php

$name = $_POST['Name'];
$surname = $_POST['Surname'];
$country = $_POST['Country'];
$bio = $_POST['Bio'];
$password = $_POST['Password'];
echo $name;
echo $surname;
echo $country;
echo $bio;
echo $password;

if(isset($_POST['submit'])){
    echo "inside isset";
    $result = mysqli_query($db, 'INSERT INTO bug_userprofile(Usr_User, Usr_Surname, Usr_Country, Usr_Bio, Usr_Password) WHERE Usr_User="'.$name.'" AND Usr_Surname="'.$surname.'" AND Usr_Country="'.$country.'" AND Usr_Bio="'.$bio.'" AND Usr_Password="'.$password.'"');

}

echo "Result = ";
echo $result;

?>
<ul>
    <li><a href="http://1301070cameronbug.azurewebsites.net/development/homepage.php">Cancel</a></li>
</ul>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>
