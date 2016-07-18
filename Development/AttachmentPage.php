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

<?php $sql_queryAttachments = "SELECT * FROM  bug_attachment WHERE Att_BugUniqueID = '1' DESC limit 50";
// execute the SQL query
$resultAttachments = $db->query($sql_queryAttachments);
?>
<h1>Attachments</h1>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th></th>
    </tr>

    <?php
    while($BugAttachments = mysqli_fetch_assoc($resultAttachments)) {
        echo "<tr>";
        echo "<td>" . $BugAttachments['Att_BugUniqueID']."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
    
    </body>
</html>

    