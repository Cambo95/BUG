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
        $NumberVerified = 0;
        $sql = "SELECT COUNT(Usr_User) as NumberVerified from bug_userprofile where Usr_IsVerified = 1";
        $result = mysqli_query($db, $sql);
        $Bug = mysqli_fetch_assoc($result);
        $NumberVerified = $Bug['NumberVerified'];
        echo "Number of verified users: ",$NumberVerified;



?>
<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>