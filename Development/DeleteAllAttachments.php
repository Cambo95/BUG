<?php
session_start();
$UserLoggedOn = $_SESSION["username"];
$isadmin = $_SESSION['isadmin'];
$bugid=$_GET["bugid"];
$comuser = $_GET["comuser"];
$comdatetime = $_GET["comdatetime"];
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
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body>
<?php include 'CommonHeader.php';?>
<br><br><br><br>

<h3>You have requested to delete all attachments for this bug</h3>
<br>
<br>

<?php if($isadmin == 1): ?>
    <form action='' method="POST">
        <input type="submit" name="DeleteSingle" value="Confirm deletion of all attachments">
    </form>
<?php endif; ?>

<?php
if ($isadmin == 1) {
    if (isset($_POST['DeleteSingle'])) {
        $deletesql = "DELETE FROM bug_attachment WHERE Att_BugUniqueID = $bugid";
        $result = mysqli_query($db, $deletesql);
        header("Location: BugWithComments.php?bugid=$bugid");
    }
}


if ($isadmin == 0) {
    $errormessage = "Sorry, you are not authorised to delete these attachments as you are not an administrator. Press return to continue. ";
    echo "<br>";
    echo "<strong>";
    echo $errormessage;
    echo "<br>";
    echo "<td>" . '<a href="BugWithComments.php?bugid='.$bugid.'">'.'Return'.'</a>'."</td>";
    echo "</strong>";
}
?>

<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>