<?php
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
$sql_query = "SELECT * FROM  bug_userprofile";
// execute the SQL query
$result = $db->query($sql_query);

/** ======================================================================= */


?>


<html>
<head>
    <title>Bug Site</title>
</head>
<body>
<?php include 'CommonHeader.php';?>
<br><br><br>

<h5>User:</h5> <?php
while($User = mysqli_fetch_assoc($result)) {
    echo "<td>" . $User['Usr_User']."</td>";  echo "</tr>";
}?>
<br>
<br>
<h5>Country:</h5> <?php
while($Country = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Country['Usr_Country']."</td>";
}?>
<br>
<br>
<h5>Bio:</h5> <?php
while($Bio = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Bio['Usr_Bio']."</td>";
}?>
<br>
<br>
<h5>Date Joined:</h5> <?php
while($Date = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Date['Usr_Joined'] . "</td>";
}?>
</table>
<br><br><br><br><br><br><br><br>
<?php include 'CommonFooter.php';?>
</body>
</html>