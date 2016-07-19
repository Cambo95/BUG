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
    <ul>
        <li><a href="http://1301070cameronbug.azurewebsites.net/development/registration.php">Register</a></li>
    </ul>
</head>
<body>
    <?php include 'CommonHeader.php';?>
    <?php include 'CommonLogin.php';?>
    
    <p>Search for Bugs:</p>
    <form>
        <input type="text" name="search" placeholder="Search...">
    </form>


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
    while($Bug = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "<td>" . $Bug['Inst_BugUniqueID']."</td>";
        echo "<td>" . $Bug['Inst_User']."</td>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        //echo "<td>" . "<a href="useralbugs.php?key=$Bug['Inst_BugUniqueID']">View Bug</a>";
        echo "</tr>";
    }//end while
    ?>
    </table>
<br><br><br><br><br><br><br><br>
    
    <?php include 'CommonFooter.php';?>
</body>
</html>