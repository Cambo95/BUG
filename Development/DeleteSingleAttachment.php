<?php
session_start();
$UserLoggedOn = $_SESSION["username"];
$bugid=$_GET["bugid"];
$attuser = $_GET["attuser"];
$attdatetime = $_GET["attdatetime"];
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

<h3>You have requested to delete this attachment</h3>
<br>
<br>

<?php if($UserLoggedOn == $attuser): ?>
    <form action='' method="POST">
        <input type="submit" name="DeleteSingle" value="Confirm deletion of attachment">
    </form>
<?php endif; ?>

<?php
echo "User is ";
echo $attuser;
echo "Bug ID is ";
echo $bugid;
echo "Date time is ";
echo $attdatetime;

if ($UserLoggedOn == $attuser) {
    if (isset($_POST['DeleteSingle'])) {
        $deletesql = "DELETE FROM bug_attachments WHERE Att_BugUniqueID = $bugid AND Att_User = $attuser AND Att_DateTime = $attdatetime";
        $result = mysqli_query($db, $deletesql);
        header("Location: BugWithComments.php?bugid=$bugid");
    }
}


if ($UserLoggedOn !== $attuser) {
    $errormessage = "Sorry, you are not authorised to delete this attachment as you are not the author of it. Press return to continue. ";
    echo "<br>";
    echo "<strong>";
    echo $errormessage;
    echo "<br>";
    echo "<td>" . '<a href="BugWithComments.php?bugid='.$bugid.'">'.'Return'.'</a>'."</td>";
    echo "</strong>";
}
?>

<br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>
