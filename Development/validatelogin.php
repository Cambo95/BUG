<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<body>

Welcome <?php
$username = $_POST['username'];
$password = $_POST['password'];
$allfieldsfull = 'Y';
if(empty($username)){
    echo'Username is empty';
    $allfieldsfull = 'N';
    }else{
        echo $username;
    }
if(empty($password)){
    echo'Password is empty';
    $allfieldsfull = 'N';
}else{
    echo $password;
}
if ($allfieldsfull = 'N'){
    echo 'One or both fields is empty. Click here to try again.';
}else{
    echo 'Retrieving login from database';
}
?>
</body>
</html>
