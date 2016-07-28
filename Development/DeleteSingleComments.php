<?php
session_start();
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

You have requested to delete this bug.

<?php if($UserLoggedOn!==''): ?>
    <form action='' method="POST">
        <input type="submit" name="DeleteSingle" value="Confirm deletion of comment">
    </form>
<?php endif; ?>

<?php
echo "Bug ID equals...";
$bugid=$_GET["bugid"];
echo $bugid;
echo "<br>";
if (isset($_POST['DeleteSingle'])){
    echo("About to dump array POST");
    var_dump($_POST);
    $deletesql = "DELETE FROM bug_comments WHERE Com_BugUniqueID = $bugid";
    echo $deletesql;
    $result = mysqli_query($db, $deletesql);
    echo "About to echo sql";
    echo $result;
    
}
?>

<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>
