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

<?php $sqlimage = "SELECT * FROM bug_attachment WHERE Att_BugUniqueID = '1'";
$imageresult1 = mysqli_query($sqlimage);

while($rows = mysqli_fetch_assoc($imageresult1))
{
    $image = $rows['Att_Object'];
    echo "Hello";
    echo'<img height="300" width="300" src="data:image;base64,'.$rows['Att_Object'].'">';
}
?>


<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>

    