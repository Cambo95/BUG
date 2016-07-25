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
session_start();
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
    <p>Search for Bugs:</p>
    <form>
        <input type="text" name="search" placeholder="Search...">
    </form>
        <?php $sql_query = "SELECT * FROM  bug_instances ORDER BY Inst_BugUniqueID DESC limit 5";
        // execute the SQL query
            $result = $db->query($sql_query);
        ?>
<h3>Recent Bugs</h3>
    <table class="w3-table w3-bordered w3-striped">
        <tr class="w3-teal">
            <th>Date</th>
            <th>BugID</th>
            <th>User</th>
            <th>Title</th>
        </tr>
    
    <?php
    
    while($Bug = mysqli_fetch_assoc($result)) {
        $bugid=$Bug['Inst_BugUniqueID'];
        echo "<tr>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "<td>" . $Bug['Inst_BugUniqueID']."</td>";
        echo "<td>" . $Bug['Inst_User']."</td>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        echo '<a href="BugWithComments.php?bugid=$bugid">Edit</a>';
        //echo "<td>" . "<a href="useralbugs.php?key=$Bug['Inst_BugUniqueID']">View Bug</a>";
        echo "</tr>";
    }//end while
    ?>
    </table>
<br><br><br><br><br><br><br><br>
    
    <?php include 'CommonFooter.php';?>
</body>
</html>