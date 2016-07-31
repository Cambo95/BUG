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

    <form action='' method="POST">
        <input type="text" name="search" placeholder="Search...">
        <input type="submit" name="submit" value="Search">
    </form>
    <?php

    if(isset($_POST['submit'])) {
        $searchstring = "'%".$_POST['search']."%'";
        $sql_queryHome = "SELECT * FROM  bug_instances WHERE (Inst_User LIKE $searchstring OR Inst_Description LIKE $searchstring OR Inst_Title LIKE $searchstring) ORDER BY Inst_BugUniqueID DESC";
        $result = $db->query($sql_queryHome);
    }
    if(($_POST['search']=='')){
        $sql_queryHome = "SELECT * FROM  bug_instances ORDER BY Inst_BugUniqueID DESC limit 5";
        $result = $db->query($sql_queryHome);
    }

    ?>
<h3>Recent Bugs</h3>
    <p>(If search is blank only 5 most recent bugs are shown. If search is used every matching search is displayed)</p>
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
        $buguser=$Bug['Inst_User'];
        echo "<tr>";
        echo "<td>" . $Bug['Inst_DatePosted']."</td>";
        echo "<td>" . '<a href="BugWithComments.php?bugid='.$bugid.'">'.$bugid.'</a>'."</td>";
        echo "<td>" . '<a href="Bug_Userprofile_Display.php?paramuser='.$buguser.'">'.$buguser.'</a>'."</td>";
        echo "<td>" . $Bug['Inst_Title']."</td>";
        echo "</tr>";
    }//end while
    ?>
    </table>
<br><br><br><br><br><br><br><br>
    
    <?php include 'CommonFooter.php';?>
</body>
</html>