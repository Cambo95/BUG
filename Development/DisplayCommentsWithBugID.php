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
$resultDescribe = $db->query($sql_query);
$resultUser = $db->query($sql_query);
$resultDate = $db->query($sql_query);

$result1 = $db->query($sql_query1);

?>
<?php include 'CommonHeader.php';?>
<html>
<head>
    <style>

        h5{
            color: blue;
        }
    </style>
</head>
<body>
<br><br><br>

<h5>Title:</h5> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Bug['Inst_Title']."</td>";  echo "</tr>";
}?>
<br>
<br>
<h5>Description:</h5> <?php
while($Describe = mysqli_fetch_assoc($resultDescribe)) {
    echo "<td>" . $Describe['Inst_Description']."</td>"; 
}?>
<br>
<br>
<h5>User:</h5> <?php
while($User = mysqli_fetch_assoc($resultUser)) {
    echo "<td>" . $User['Inst_User']."</td>"; 
}?>
<br>
<br>
<h5>Date Posted:</h5> <?php
while($Date = mysqli_fetch_assoc($resultDate)) {
    echo "<td>" . $Date['Inst_DatePosted']."</td>"; 
}?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>