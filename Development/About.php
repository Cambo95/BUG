<?php
session_start();
$UserLoggedOn = $_SESSION["username"];
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
<br><br>

<h3>Site statistics</h3>
<br>
<br>


<?php
// ****************************************************************************
$sql = "SELECT COUNT(Usr_User) as total from bug_userprofile where Usr_IsVerified = 1";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of verified users: ",$total;
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Usr_User) as total from bug_userprofile where Usr_IsVerified = 0";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of users awaiting verification: ",$total;
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Inst_BugUniqueID) as total from bug_instances where Inst_DateFixed = 'NULL'";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of open bugs: ",$total;
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Inst_BugUniqueID) as total from bug_instances where Inst_DateFixed <> NULL";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of fixed bugs: ",$total;
echo "<br>";
?>
<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>