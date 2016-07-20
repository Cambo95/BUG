<?php
/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 13/07/2016
 * Time: 16:25
 */

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

<form action='' method="post">
    <label>Username</label><input type=“text” name=“Username”>
    <label>Password</label><input type=“password” name=“Password”>
    <input type="submit" name="submit">
</form>
<?php
session_start();



$user=$_REQUEST['Username'];
$pass=$_REQUEST['Password'];
echo "username1";
echo $user;
echo "password1";
echo $pass;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "Entry point 1";
        $username=mysqli_real_escape_string($db,$_POST['Username']);
        $password=mysqli_real_escape_string($db,$_POST["Password"]);
        echo "username2";
        echo $user;
        echo "password2";
        echo $pass;
        $sql = "SELECT Usr_User FROM bug_userprofile WHERE Usr_User = '$user' and Usr_Password ='$pass'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];

        $count = mysqli_num_rows($result);
        echo "Count rows returned = ";
        echo $count;
        if($count == 1){
            $SESSION['login_user']= $username;
            header("location: commonlogin.php");
        }
        else{
            $error = "Your Login Name or Password is invalid";
        }
}
?>
</body>
</html>

