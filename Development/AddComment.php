<?php

/** Resume the session to retrieve the parameters setup at login */
session_start();

/** =====================================================================================*/
/**
 * Created by PhpStorm.
 * User: Cambo
 *
 * PURPOSE : This is the Attachment Page - It allows the person who created a bug to select
 *           and upload attachments against the Bug they have created
 *
 * SECURITY : This page is only available to Users who are logged in
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
/** ===============================================================================*/
?>

<!-- ============================================================================== -->
<!-- Set up the Tab name -->
<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
<body>

<!-- Bring in the common header script -->
<?php include 'CommonHeader.php';?>

<!-- Set up a button to allow User to search for an object to be attached to the bug -->
<!-- Set up a save button for User to press once file is selected  -->
<?php
$UserLoggedOn = $_SESSION["username"];
if($UserLoggedOn!==''): ?>
    <form action='' method="POST">
        Add comment:<br>
        <input type="text" name="Comment">
        <br>
        <br>
        <input type="submit" name="submit">
    </form>
<?php endif; ?>

<!-- ============================================================================== -->
<?php
// Retrieve the BugUniqueID that the User selected in previous screen from the URL parameter
$bugid=$_GET["bugid"];

/** If the SUBMIT button was pressed insert the comment entered by the user into table */
/** bug_comments */
if(isset($_POST['submit'])) {
$UserLoggedOn = $_SESSION["username"];
$Comment = $_POST['Comment'];
if ($UserLoggedOn == ""){
echo "Please log on to add comments";
}
else {
if ($Comment == "") {
echo "Please insert a comment";
} else {
$sql = "INSERT INTO bug_comments(Com_BugUniqueID, Com_User, Com_Comment)
VALUES($bugid,'$UserLoggedOn','$Comment')";

if (mysqli_query($conn, $sql)) {
$_POST['Comment']='';
    header("Location: BugWithComments.php?bugid=$bugid");
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
}
}
$conn->close();
?>


<br><br><br><br><br><br><br><br>

<!-- Setup the footer  -->
<?php include 'CommonFooter.php';?>

</body>
</html>