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

$bugid=$_GET["bugid"];


/** Setup the SQL statement */
$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = $bugid";

/** Retrieve the record from the tabl */
$result = $db->query($sql_query);
$sqlrow   = mysqli_fetch_assoc($result);

/** load up the display variables */
$bugbug   = $sqlrow['Inst_BugUniqueID'];
$bug      = $sqlrow['Inst_Title'];
$describe = $sqlrow['Inst_Description'];
$user     = $sqlrow['Inst_User'];
$userReportedBy = $sqlrow['Inst_ReportedBy'];
$date     = $sqlrow['Inst_DatePosted'];
$datefixed= $sqlrow['Inst_DateFixed'];
$UserLoggedOn = $_SESSION["username"];
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
Update any or all of the following fields:
<br><br>
<form action='' method="POST">
    Bug Title:<br>
    <input type ="text" name="BugTitle" value = $bug>
    <br>
    Description:<br>
    <input type="text" name="Description" value = "$describe">
    <br>
    Reported By:<br>
    <input type="text" name="ReportedBy" placeholder = "$userReportedBy">
    <br>
    <input type="submit" name="submit" value = "Save">
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
        $sql = "UPDATE bug_instances SET (Inst_Title, Inst_Description, Inst_ReportedBy)
        VALUES('$BugTitle','$BugDescription','$BugReportedBy') WHERE (Inst_BugUniqueID = $bugid)";

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