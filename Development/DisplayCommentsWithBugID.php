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

$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = '1'";
$sql_query1 = "SELECT * FROM bug_comments WHERE Com_BugUniqueID = '1'";
// execute the SQL query
$result = $db->query($sql_query);
$result1 = $db->query($sql_query1);

?>
<?php include 'CommonHeader.php';?>
<html>
<head>
    <title>Bug Site</title>
</head>
<body>
<br><br><br>

Title: <br> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $Bug['Inst_Title']."</td>";  echo "</tr>";
}?>

Description: <br> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $Bug['Inst_Description']."</td>"; 
}?>

User: <br> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $Bug['Inst_User']."</td>"; 
}?>
    
Date Posted: <br> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $Bug['Inst_DatePosted']."</td>"; 
}?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>