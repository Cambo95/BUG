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

$sql_query = "SELECT * FROM  bug_instances WHERE Inst_User = 'CAM'";
// execute the SQL query
$result = $db->query($sql_query);


?>

<?php include 'TestHeader.php';?>

<table width="600" border="1" cellpadding="1" cellspacing="1">
    <tr>
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