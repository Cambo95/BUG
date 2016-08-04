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
<br>
<h1>Welcome</h1>
<p>Welcome to Splat! Bug Catcher. This site is where you will find the answer to all your online<br>
computer bug problems. Register as a user to add comments on pre-existing bugs or create your<br>
own bugs and add attachments that you find applicable. Our dedicated administrators will verify<br>
your account and then you will be free to contribute.<br>
Below you will find statistics about the site.<br>
Thank you for visiting.</p>
<br>
<h2>Site statistics</h2>
<br>

<?php
// ****************************************************************************
$sql = "SELECT COUNT(Usr_User) as total from bug_userprofile where Usr_IsVerified = 1";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "<strong>USER STATISTICS</strong>";
echo "<br>";
echo "Number of verified users: ",$total;
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Usr_User) as total from bug_userprofile where Usr_IsVerified = 0";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of users awaiting verification: ",$total;
echo "<br>";
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Inst_BugUniqueID) as total from bug_instances where Inst_DateFixed IS NULL";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "<strong>BUG STATISTICS</strong>";
echo "<br>";
echo "Number of open bugs: ",$total;
echo "<br>";
// ****************************************************************************
$sql = "SELECT COUNT(Inst_BugUniqueID) as total from bug_instances where Inst_DateFixed IS NOT NULL";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$total = $answer['total'];
echo "Number of fixed bugs: ",$total;
echo "<br>";
echo "<br>";
// ****************************************************************************
$sql = "SELECT Inst_User, COUNT(*) as total from bug_instances group by Inst_User order by count(*) desc limit 3";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$Inst_User = $answer['Inst_User'];
$count = $answer['total'];
echo "<strong>TOP BUG CREATORS</strong>";
echo "<br>";
echo "...1:",$Inst_User, " With ", $count, " posts.";
echo "<br>";
$answer = mysqli_fetch_assoc($result);
$Inst_User = $answer['Inst_User'];
$count = $answer['total'];
echo "...2:",$Inst_User, " With ", $count, " posts.";
echo "<br>";
$answer = mysqli_fetch_assoc($result);
$Inst_User = $answer['Inst_User'];
$count = $answer['total'];
echo "...3:",$Inst_User, " With ", $count, " posts.";
echo "<br>";
echo "<br>";
// ****************************************************************************
$sql = "SELECT Com_User, COUNT(*) as total from bug_comments group by Com_User order by count(*) desc limit 3";
$result = mysqli_query($db, $sql);
$answer = mysqli_fetch_assoc($result);
$Com_User = $answer['Com_User'];
$count = $answer['total'];
echo "<strong>TOP COMMENTERS</strong>";
echo "<br>";
echo "...1:",$Com_User, " With ", $count, " comments.";
echo "<br>";
$answer = mysqli_fetch_assoc($result);
$Com_User = $answer['Com_User'];
$count = $answer['total'];
echo "...2:",$Com_User, " With ", $count, " comments.";
echo "<br>";
$answer = mysqli_fetch_assoc($result);
$Com_User = $answer['Com_User'];
$count = $answer['total'];
echo "...3:",$Com_User, " With ", $count, " comments.";
echo "<br>";
?>
<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>