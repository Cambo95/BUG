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
    Reported By:<br>
    <input type="text" name="ReportedBy">
    <br>
    <input type="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])) {
    $BugTitle = mysqli_real_escape_string($db, $_POST["BugTitle"]);
    $BugDescription = mysqli_real_escape_string($db, $_POST["Description"]);
    $BugReportedBy = mysqli_real_escape_string($db, $_POST["ReportedBy"]);
    $UserLoggedOn = $_SESSION["username"];
if ($BugTitle == "" OR $BugDescription == "" OR $BugReportedBy == "") {
echo "Bug Title and Description and Reported By must be filled in to submit";
} else {
$sql = "INSERT INTO bug_instances(Inst_Title, Inst_Description, Inst_User, Inst_ReportedBy)
        VALUES('$BugTitle','$BugDescription','$UserLoggedOn','$BugReportedBy')";
  
if (mysqli_query($db, $sql)) {
    header("Location: HomePage.php?username=$UserLoggedOn");
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