<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body>
<?php include 'CommonHeader.php';?>

<?php if($UserLoggedOn!==''): ?>
    <form action='' method="POST">
        <input type="submit" name="Delete" value="Confirm deletion of comment">
    </form>
<?php endif; ?>

<?php include 'CommonFooter.php';?>
</body>
</html>
