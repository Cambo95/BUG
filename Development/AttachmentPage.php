<?php
session_start();
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

<form action="" method="post" enctype="multipart/form-data">
<table border = "1" width = "80%">
    <tr>
        <th width = "50%">Upload Image</th>
        <td width = "50%"><input type ="file" name = "txt_image"</td>
    </tr>
    <tr>
        <td></td>
        <td><input type = "submit" name = "submit" value = "Save"></td>
    </tr>
</table>
</form>

<?php
$buguniqueid=$_GET["buguniqueid"];
var_dump($_FILES);
if(isset($_POST["submit"])) {
    if ($_FILES['submit']['size'] > 0){
        $fileName = $_FILES['submit']['name'];
        $tmpName  = $_FILES['submit']['tmp_name'];
        $fileSize = $_FILES['submit']['size'];
        $fileType = $_FILES['submit']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);

        echo 'dumping the FILES content - ';
    $UserLoggedOn = $_SESSION["username"];
    echo "User pressed Save";
    $sql = "INSERT INTO bug_attachment(Att_BugUniqueID, Att_User, Att_Object)
            VALUES('$buguniqueid','$UserLoggedOn','$content')";
    if (mysqli_query($db, $sql)) {
        echo "Records added successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
}
$db->close();
?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>

    