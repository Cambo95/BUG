<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

Welcome <?
if(empty($_POST)){
    echo'$_POST was not entered. Please try again';
else{
        echo $_POST['username'];
    }
}
?>


</body>
</html>
