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
$servername =  "eu-cdbr-azure-west-d.cloudapp.net";
$username = "b05411072e2e07";
$password = "2e5e5133";
$dbname = "1301070";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $surname = mysqli_real_escape_string($conn, $_POST['Surname']);
    $country = mysqli_real_escape_string($conn, $_POST['Country']);
    $bio = mysqli_real_escape_string($conn, $_POST['Bio']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($name == "" OR $password == "") {
        echo "Password or Username is blank. Please enter.";
} else {
        $sql = "INSERT INTO bug_userprofile(Usr_User, Usr_Surname, Usr_Country, Usr_Bio, Usr_Password)
VALUES('$name','$surname','$country','$bio','$password')";

        if (mysqli_query($conn, $sql)) {
            echo "Records added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>

<ul>
    <li><a href="http://1301070cameronbug.azurewebsites.net/development/homepage.php">Cancel</a></li>
</ul>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>
