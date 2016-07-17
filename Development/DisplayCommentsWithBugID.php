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
        h2{
            color: blue;
        }
        h3{
            color: blue;
        }
        h4{
            color: blue;
        }
        h5{
            color: blue;
        }
    </style>
</head>
<body>
<br><br><br>

<h2>Title:</h2> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Bug['Inst_Title']."</td>";  echo "</tr>";
}?>
<br>
<br>
<h3>Description:</h3> <?php
while($Describe = mysqli_fetch_assoc($resultDescribe)) {
    echo "<tr>";
    echo "<td>" . $Describe['Inst_Description']."</td>"; 
}?>
<br>
<br>
<h4>User:</h4> <?php
while($User = mysqli_fetch_assoc($resultUser)) {
    echo "<tr>";
    echo "<td>" . $User['Inst_User']."</td>"; 
}?>
<br>
<br>
<h5>Date Posted:</h5> <?php
while($Date = mysqli_fetch_assoc($resultDate)) {
    echo "<tr>";
    echo "<td>" . $Date['Inst_DatePosted']."</td>"; 
}?>

<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
</html>