<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

Welcome <?php
$username = $_POST['username'];
if(empty($username)){
    echo'Username is empty';
    }else{
        echo $username;
    }
?>
</body>
</html>
