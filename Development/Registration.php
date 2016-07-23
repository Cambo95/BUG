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
    <head>
        <title>SPLAT! Bug Catcher</title>
    </head>
    <body>
<?php include 'CommonHeader.php';?>

<br><br><br>

        <form>
            Name:<br>
            <input type="text" name="Name">
            <br>
            Surname:<br>
            <input type="text" name="Surname">
            <br>
            Country:<br>
            <input type="text" name="Country">
            <br>
            Bio:<br>
            <input type="text" name="Bio" maxlength="1000">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br>
            <br>
            <input type="submit" value="Submit">
        </form>

<?php
    If(isset($_REQUEST['submit'])!=''){
        if($_REQUEST['Name']=='' || $_REQUEST['Surname']=='' || $_REQUEST['Country']=='' || $_REQUEST['Bio']==''|| $_REQUEST['password']==''){
            echo "You cannot have leave fields blank";
        }
        else{
            $result = mysqli_query($db, "INSERT INTO bug_userprofile(Usr_User,Usr_Surname,Usr_Country,Usr_Bio,Usr_Password) values('".$_REQUEST['Name']."','".$_REQUEST['Surname']."','".$_REQUEST['Country']."','".$_REQUEST['Bio']."','".$_REQUEST['Password']."'");
            If($result){
                echo "Records successfully inserted";
            }
            else{
                echo "There is some problem in inserting record";
            }
        }
    }
?>
<ul>
    <li><a href="http://1301070cameronbug.azurewebsites.net/development/homepage.php">Cancel</a></li>
</ul>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    </body>
</html>
