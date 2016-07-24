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

$con=mysqli_connect($db);
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);

 function NewUser(){
     $name = $_POST['Name'];
     $surname = $_POST['Surname'];
     $country = $_POST['Country'];
     $bio = $_POST['Bio'];
     $password = $_POST['Password'];
     $query = "INSERT INTO bug_userprofile(Usr_User, Usr_Surname, Usr_Country, Usr_Bio, Usr_Password) VALUES ('$name','$surname','$country','$bio','$password')";
     if($query);
     {
         echo "YOUR REGISTRATION IS COMPLETED";
     }
 }

/*/function SignUp()
{
    if (!empty($_POST['Name'])) {
        $query = mysqli_query("SELECT * FROM bug_userprofile WHERE Usr_User = '$_POST[Name]'AND Usr_Password = '$_POST[Password]'");

        if (!$row = mysqli_fetch_array($query)) {
            NewUser();
        } else {
            echo "SORRY, YOU ARE ALREADY A REGISTERED USER";
        }
    }
}
        if(isset($_POST['submit'])){
            SignUp();
    
}/*/

?>
<ul>
    <li><a href="http://1301070cameronbug.azurewebsites.net/development/homepage.php">Cancel</a></li>
</ul>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>
