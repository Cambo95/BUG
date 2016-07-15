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

    <table width="600" border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>Date</th>
            <th>BugID</th>
            <th>User</th>
            <th>Title</th>
        </tr>
    </table>
    <?php
    
    while($Bug = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "<td>" . $Bug['Inst_BugUniqueID']."</td>";
        echo "<td>" . $Bug['Inst_User']."</td>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        echo "</tr>";
    }//end while
    ?>


    <?php include 'CommonFooter.php';?>
</body>
</html>