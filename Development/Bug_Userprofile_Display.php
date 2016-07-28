<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 13/07/2016
 * Time: 16:25
 */

/** Setup Database Connection */
/** ======================================================================= */
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
/** ======================================================================= */



/** Select ALL records from table */
/** ======================================================================= */

$paramuser = $_GET['paramuser'];
if ($paramuser == ''){
    $username = $_SESSION['username'];
}else{
    $username = $paramuser;
}

$query = "SELECT * FROM  bug_userprofile WHERE Usr_User = '$username'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($result);

$dispuser = $row['Usr_User'];
$discountry = $row['Usr_Country'];
$dispbio = $row['Usr_Bio'];
$dispjoindate = $row['Usr_JoinedDate'];
$dispisverified = $row['Usr_IsVerified'];
$dispisadmin = $row['Usr_IsAdministrator'];


/** ======================================================================= */

?>

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
<?php include 'CommonFooter.php';?>
</body>
</html>