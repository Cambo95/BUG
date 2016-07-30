<?php
session_start();
/** =====================================================================================*/
/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 13/07/2016
 * Time: 16:25
 *
 * PURPOSE : This is the Administration Page - It allows administrators to Verify Users
 * SECURITY : This page is only available to Users who are tagged as "UserIsAdmin"
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
/** ===============================================================================*/
?>



<!-- ============================================================================== -->
<!-- Set up the Tab name -->
<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
    <body>

    <!-- Bring in the common header script -->
<?php include 'CommonHeader.php';?>
    <!-- ============================================================================== -->

    <!-- Set up the sql string to select all Users -->
<?php $sql_queryAdmin = "SELECT * FROM  bug_userprofile ORDER BY Usr_IsVerified";

// execute the SQL query
$resultAdmin = $db->query($sql_queryAdmin);
?>

    <!-- Setup table header and titles -->
<h1>Admin</h1>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>User</th>
        <th>Surname</th>
        <th>User Country</th>
        <th>User Joined</th>
        <th>User is Admin (1=Yes/0=No)</th>
        <th>User Is Verified? (1=Yes/=No)</th>
    </tr>

    <!-- Process through all the retrieved rows and display on screen -->
    <!-- Setup a link field with the title 'Verify User' to allow Admin to select user for verification -->
    <!-- The link field has a URL parameter called verifyusername and the User name is -->
    <!-- concatenated to the URL so that when Admin clicks on the link it calls Verify.PHP and -->
    <!-- passes the User name through to that php -->
    <?php
    while($Admin = mysqli_fetch_assoc($resultAdmin)) {
        $verifyusername=$Admin['Usr_User'];
        echo "<tr>";
        echo "<td>" . $Admin['Usr_User']."</td>";
        echo "<td>" . $Admin['Usr_Surname']."</td>";
        echo "<td>" . $Admin['Usr_Country']."</td>";
        echo "<td>" . $Admin['Usr_JoinedDate']."</td>";
        echo "<td>" . $Admin['Usr_IsAdministrator']."</td>";
        echo "<td>" . $Admin['Usr_IsVerified']."</td>";
        echo "<td>" . '<a href="Verify.php?verifyusername='.$verifyusername.'">Verify User</a>'."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>
<br><br><br><br><br><br><br><br>


    <!-- Setup the footer  -->
<?php include 'CommonFooter.php';?>
    
    </body>
</html>
    