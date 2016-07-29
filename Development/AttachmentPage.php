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

if(isset($_POST['submit'])) {
    if ($_FILES['txt_image']['size'] > 0){
        
        $fileName = $_FILES['txt_image']['name'];
        $tmpName  = $_FILES['txt_image']['tmp_name'];
        $fileSize = $_FILES['txt_image']['size'];
        $fileType = $_FILES['txt_image']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);
        if(!get_magic_quotes_gpc())
        {
            $fileName = addslashes($fileName);
        }
        $UserLoggedOn = $_SESSION["username"];
    $sql = "INSERT INTO bug_attachment(Att_BugUniqueID, Att_User, Att_Object, Att_Objectname, Att_Objecttype, Att_Objectsize)
            VALUES('$buguniqueid','$UserLoggedOn','$content','$fileName','$fileType','$fileSize')";
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

    