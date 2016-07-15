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
    <?php include 'CommonLogin.php';?>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/production/useralbugs.php">Register (Page Not linked yet)</a></li>
        </ul>


        <?php $sql_query = "SELECT * FROM  bug_instances ORDER BY Inst_BugUniqueID DESC limit 5";
        // execute the SQL query
            $result = $db->query($sql_query);
        ?>
<h1>Recent Bugs</h1>
    <table class="w3-table w3-bordered w3-striped">
        <tr class="w3-teal">
            <th>Date</th>
            <th>BugID</th>
            <th>User</th>
            <th>Title</th>
        </tr>
    
    <?php
    $weburl = '"http://1301070cameronbug.azurewebsites.net/production/useralbugs.php?Bug_UniqueID='
    while($Bug = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "<td>" . $Bug['Inst_BugUniqueID']."</td>";
        echo "<td>" . $Bug['Inst_User']."</td>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        $dynamicurl = $weburl . $Bug['Inst_BugUniqueID'] . '"> GO </a></li>' ;
        echo "<td>" . $dynamicurl."</td>";
        echo "</tr>";
    }//end while
    ?>
    </table>


    <?php include 'CommonFooter.php';?>
</body>
</html>