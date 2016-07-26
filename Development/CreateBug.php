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
<br><br><br>
Please title your bug and provide a description... 
<br><br>
<form action='' method="POST">
    Bug Title:<br>
    <input type ="text" name="BugTitle">
    <br>
    Description:<br>
    <input type="text" name="Description">
    <br>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])) {
    $BugTitle = mysqli_real_escape_string($db, $_POST["BugTitle"]);
    $BugDescription = mysqli_real_escape_string($db, $_POST["Description"]);
    $UserLoggedOn = $_SESSION["username"];
if ($BugTitle == "" OR $BugDescription == "") {
echo "Bug Title and Description must be filled in to submit";
} else {
$sql = "INSERT INTO bug_instances(Inst_Title, Inst_Description, Inst_User)
        VALUES('$BugTitle','$BugDescription','$UserLoggedOn')";
  
if (mysqli_query($db, $sql)) {
echo "Records added successfully";
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
}
}
$db->close();
?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>