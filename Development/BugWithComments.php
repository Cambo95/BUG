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

$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = '1'";
$result = $db->query($sql_query);
$resultDescribe = $db->query($sql_query);
$resultUser = $db->query($sql_query);
$resultDate = $db->query($sql_query);

$sql_queryComments = "SELECT * FROM bug_comments WHERE Com_BugUniqueID = '1' ORDER BY Com_BugUniqueID DESC limit 50";
$resultComments = $db->query($sql_queryComments);
?>
<?php include 'CommonHeader.php';?>
    <html>
<head>
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
<br><br><br>

<h5>Title:</h5> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Bug['Inst_Title']."</td>";  echo "</tr>";
}?>
<br>
<br>
<h5>Description:</h5> <?php
while($Describe = mysqli_fetch_assoc($resultDescribe)) {
    echo "<td>" . $Describe['Inst_Description']."</td>";
}?>
<br>
<br>
<h5>User:</h5> <?php
while($User = mysqli_fetch_assoc($resultUser)) {
    echo "<td>" . $User['Inst_User']."</td>";
}?>
<br>
<br>
<h5>Date Posted:</h5> <?php
while($Date = mysqli_fetch_assoc($resultDate)) {
    echo "<td>" . $Date['Inst_DatePosted'] . "</td>";
}?>

<h4>Comments</h4>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>User</th>
        <th>Date+Time posted</th>
        <th>Comment</th>
    </tr>
    <?php
    while($Comment = mysqli_fetch_assoc($resultComments)) {
        echo "<tr>";
        echo "<td>" . $Comment['Com_User']."</td>";
        echo "<td>" . $Comment['Com_DateTime']."</td>";
        echo "<td>" . $Comment['Com_Comment']."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>
<form method = 'post'>
    
Comment:<br />
<textarea name='comment' id='comment'><</textarea><br />
<input type='hidden' name='Com_BugUniqueID' id='Com_BugUniqueID' value='<? echo $_GET["id"]; ?>' />
<input type='submit' value='Submit' />
</form>
    <br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
    </html>