<?php

/** Resume the session to retrieve the parameters setup at login */
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
/** ======================================================================= */



/** Select ALL records from table */
/** ======================================================================= */

/** retrieve the User from the URL parameter */
$paramuser = $_GET['paramuser'];
/** If the URL is empty then retrieve the User Logged On from the session */
/** If the URL is loaded with a username then this page was called because the */
/** User clicked on a User in the list of bugs displayed on the homepage and wants  */
/** to read their profile.  If the URL has no username then it is because this page */
/** was called becvause the person logged on pressed the PROFILE link to review his own */
/** details AND change them if he wants.  */
if ($paramuser == ''){
    $username = $_SESSION['username'];
}else{
    $username = $paramuser;
}

/** Select the record for the User  */
$query = "SELECT * FROM  bug_userprofile WHERE Usr_User = '$username'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);

/** Setup the data to be displayed on the screen */
$dispuser = $row['Usr_User'];
$dispsurname = $row['Usr_Surname'];
$dispcountry = $row['Usr_Country'];
$dispbio = $row['Usr_Bio'];
$dispjoindate = $row['Usr_JoinedDate'];
$dispisverified = $row['Usr_IsVerified'];
$dispisadmin = $row['Usr_IsAdministrator'];


/** ======================================================================= */

?>
<?php include 'CommonHeader.php';?>

<!-- Setup the page titles and display the data retrieved from the sql table -->
<html>
<head>
    <style>
        h5{
            color: #ff0000;
        }
    </style>
</head>
<body>

<h1>Profile</h1>
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
        echo "<tr>";
        echo "<td>" .$dispuser."</td>";
        echo "<td>" .$dispsurname."</td>";
        echo "<td>" .$dispcountry."</td>";
        echo "<td>" .$dispjoindate."</td>";
        echo "<td>" .$dispisadmin."</td>";
        echo "<td>" .$dispisverified."</td>";
        echo "</tr>";
    ?>
</table>
<br>
<h5>Bio:</h5> <?php
echo "<td>" . $dispbio . "</td>";
?>

<?php $sql_query = "SELECT * FROM  bug_instances where bug_user= $dispuser ORDER BY Inst_BugUniqueID DESC ";
// execute the SQL query
$result = $db->query($sql_query);
?>

<h3>Author Contributions</h3>
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

<br><br>
<!-- Setup the footer  -->
<?php include 'CommonFooter.php';?>
</body>
</html>