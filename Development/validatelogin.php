<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

<?php echo "Welcome".$_POST["username"];
    if(empty($_POST['username']))
{
    $this->HandleError("UserName is empty!");
    return false;
}
?>


</body>
</html>
