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
$bugid=$_GET["bugid"];
$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = $bugid";
$result = $db->query($sql_query);
$resultBugID = $db->query($sql_query);
$resultDescribe = $db->query($sql_query);
$resultUser = $db->query($sql_query);
$resultDate = $db->query($sql_query);

$sql_queryComments = "SELECT * FROM bug_comments WHERE Com_BugUniqueID = $bugid ORDER BY Com_BugUniqueID DESC limit 50";
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

<h5>Bug ID:</h5> <?php
while($bugid = mysqli_fetch_assoc($resultBugID)) {
    echo "<td>" . $bugid['Inst_BugUniqueID']."</td>";
}?>
<br>
<br>

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
<br><br>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select attachment to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Add Attachment" name="submit">
</form>
<br><br>
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
<br>

<form action='' method="POST">
    Unique Username:<br>
    <input type="text" name="Comment">
    <br>
</form>    

<?php
$servername =  "eu-cdbr-azure-west-d.cloudapp.net";
$username = "b05411072e2e07";
$password = "2e5e5133";
$dbname = "1301070";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])) {
    $bugid = mysqli_real_escape_string($conn, $_POST['bugid']);
    $User = mysqli_real_escape_string($conn, $_POST['User']);
    $Date = mysqli_real_escape_string($conn, $_POST['Date+Time posted']);
    $Comment = mysqli_real_escape_string($conn, $_POST['Comment']);

    if ($Comment == ""){
        echo "Please insert a comment";
    } else {
        $sql = "INSERT INTO bug_comments(Com_BugUniqueID, Com_User, Com_DateTime, Com_Comment)
VALUES('$bugid','$User','$Date','$Comment')";

        if (mysqli_query($conn, $sql)) {
            echo "Comment added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
    </html>