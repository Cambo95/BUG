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

<?php if($UserLoggedOn!==''): ?>
    <form action='' method="POST">
        <input type="submit" name="Delete" value="Confirm deletion of comment">
    </form>
<?php endif; ?>

<br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>
