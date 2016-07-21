<?php
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
};
echo $allfieldsfull;
if ($username&&$password);{
    mysqli_select_db("1301070");
    $query = mysqli_query("SELECT * FROM ")
}
?>
</body>
</html>
