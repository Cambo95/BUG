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
$discountry = $row['Usr_Country'];
$dispbio = $row['Usr_Bio'];
$dispjoindate = $row['Usr_JoinedDate'];
$dispisverified = $row['Usr_IsVerified'];
$dispisadmin = $row['Usr_IsAdministrator'];


/** ======================================================================= */

?>


<!-- Setup the page titles and display the data retrieved from the sql table -->
<html>
<head>
    <title>Bug Site</title>
    <style>

        h4{
            color: #ff0000;
        }
        h5{
            color: #ff0000;
        }
    </style>
</head>
<body>
<?php include 'CommonHeader.php';?>

<br><br><br>

<h5>User:</h5> <?php
    echo "<td>" .$dispuser."</td>";
?>
<br>
<br>
<h5>Country:</h5> <?php
    echo "<td>" .$discountry."</td>";
?>
<br>
<br>
<h5>Bio:</h5> <?php
    echo "<td>" .$dispbio."</td>";
?>
<br>
<br>
<h5>Date Joined:</h5> <?php
    echo "<td>" .$dispjoindate."</td>";
?>
<br>
<br>
<h5>User is Verified?</h5> <?php
echo "<td>" .$dispisverified."</td>";
?>
<br>
<br>
<h5>User is Administrator?</h5> <?php
echo "<td>" .$dispisadmin."</td>";
?>
<br>
<br>
1 = Yes
<br>
0 = No
<br><br><br><br><br><br><br><br>

<!-- Setup the footer  -->
<?php include 'CommonFooter.php';?>
</body>
</html>