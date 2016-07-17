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
<?php
($Bug = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $Bug['Inst_Title']."</td>";
    echo "<td>" . $Bug['Inst_Description']."</td>";
    echo "<td>" . $Bug['Inst_User']."</td>";
    echo "<td>" . $Bug['Inst_DatePosted']."</td>";
    echo "</tr>";
}//end while
?>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>Title</th>
        <th>Description</th>
        <th>User</th>
        <th>Date Posted</th>
    </tr>
    <?php
    while($Bug = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        echo "<td>" . $Bug['Inst_Description']."</td>";
        echo "<td>" . $Bug['Inst_User']."</td>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>

</body>
</html>