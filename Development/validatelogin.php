<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

Welcome <?
$_POST = 'username';
if(empty($_POST)){
    echo'$_POST is empty';
    }else{
        echo $_POST['username'];
    }
?>
</body>
</html>
