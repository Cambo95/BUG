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
<?php include 'CommonLogin.php';?>

<table width="600" border="1" cellpadding="1" cellspacing="1">
    <tr>
        <th>Image</th>
        <th>User</th>
        <th>Country</th>
        <th>Bio</th>
        <th>Date Joined</th>
    </tr>
    <?php
    while($Row_Read = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $Row_Read['Usr_Picture']."</td>";
        echo "<td>" . $Row_Read['Usr_User']."</td>";
        echo "<td>" . $Row_Read['Usr_Country']."</td>";
        echo "<td>" . $Row_Read['Usr_Bio']."</td>";
        echo "<td>" . $Row_Read['Usr_JoinedDate']."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>

</body>
</html>