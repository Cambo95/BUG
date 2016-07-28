<?php
session_start();
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
$isadmin = $_SESSION['isadmin'];
$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = $bugid";
$result = $db->query($sql_query);
$resultBugID = $db->query($sql_query);
$resultDescribe = $db->query($sql_query);
$resultUser = $db->query($sql_query);
$resultDate = $db->query($sql_query);
$resultdatefixed = $db->query($sql_query);

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
while($bugbug = mysqli_fetch_assoc($resultBugID)) {
    echo "<td>" . $bugbug['Inst_BugUniqueID']."</td>";
}?>
<br>
<h5>Title:</h5> <?php
while($Bug = mysqli_fetch_assoc($result)) {
    echo "<td>" . $Bug['Inst_Title']."</td>";  echo "</tr>";
}?>
<br>
<h5>Description:</h5> <?php
while($Describe = mysqli_fetch_assoc($resultDescribe)) {
    echo "<td>" . $Describe['Inst_Description']."</td>";
}?>
<br>
<h5>User:</h5> <?php
while($User = mysqli_fetch_assoc($resultUser)) {
    $buguser=$User['Inst_User'];
    $UserLoggedOn = $_SESSION["username"];
    echo "<td>" . $User['Inst_User']."</td>";
}?>
<br>
<h5>Date Posted:</h5> <?php
while($Date = mysqli_fetch_assoc($resultDate)) {
    echo "<td>" . $Date['Inst_DatePosted'] . "</td>";
}?>
<br>
<h5>Date Fixed:</h5> <?php
while($datefixed = mysqli_fetch_assoc($resultdatefixed)) {
    if ($datefixed['Inst_DateFixed']){
        echo "Bug was Fixed on ";
        echo $datefixed['Inst_DateFixed'];
        $bugfixed ='Y';
        $buttontext = 'Flag as Unfixed';
    }
    if (!$datefixed['Inst_DateFixed']){
        echo "Bug is currently unfixed";
        $bugfixed ='N';
        $buttontext = 'Flag as Fixed';
    }
   
}?>
<br>

<?php if($buguser ==$UserLoggedOn): ?>
<form action='' method="POST">
    <input type="submit" name="Fixed" value = "<?php echo $buttontext;?>">
</form>
<?php endif; ?>


<?php

if ($buguser ==$UserLoggedOn ) {
    
    if (isset($_POST['Fixed'])) {
        if ($bugfixed == 'Y') {
            $updatesql = "UPDATE bug_instances SET Inst_DateFixed = NULL WHERE Inst_BugUniqueID = $bugid";
        }
        if ($bugfixed == 'N') {
            $updatesql = "UPDATE bug_instances SET Inst_DateFixed = NOW() WHERE Inst_BugUniqueID = $bugid";

        }
        $result = mysqli_query($db, $updatesql);
        header("Location: BugWithComments.php?bugid=$bugid");
    }
}
?>

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
        $comuser = $Comment['Com_User'];
        $comdatetime = $Comment['Com_DateTime'];
        
        
        echo "<td>" . $comuser."</td>";
        echo "<td>" . $comdatetime."</td>";
        echo "<td>" . $Comment['Com_Comment']."</td>";
        echo "<td>" . '<a href="DeleteSingleComments.php?bugid='.$bugid.'?comuser='.$comuser.'?comdatetime='.$comdatetime.'"></a>'."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>
<br>

<?php if($UserLoggedOn!==''): ?>
<form action='' method="POST">
    Add comment:<br>
    <input type="text" name="Comment">
    <br>
    <br>
    <input type="submit" name="submit">
</form>
<?php endif; ?>

<?php if($isadmin == 1): ?>
    <form action='' method="POST">
        <input type="submit" name="DeleteAll" value = "Delete All Comments">
    </form>
<?php endif; ?>

<?php
$servername =  "eu-cdbr-azure-west-d.cloudapp.net";
$username = "b05411072e2e07";
$password = "2e5e5133";
$dbname = "1301070";

$conn = new mysqli($servername, $username, $password, $dbname);
$bugid=$_GET["bugid"];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['DeleteAll'])) {
        $deletesql = "DELETE FROM bug_comments WHERE Com_BugUniqueID = $bugid";
    $result = mysqli_query($db, $deletesql);
    header("Location: BugWithComments.php?bugid=$bugid");
}
if(isset($_POST['submit'])) {
    $UserLoggedOn = $_SESSION["username"];
    $Comment = $_POST['Comment'];
if ($UserLoggedOn == ""){
    echo "Please log on to add comments";
}
    else {
        if ($Comment == "") {
            echo "Please insert a comment";
        } else {
            $sql = "INSERT INTO bug_comments(Com_BugUniqueID, Com_User, Com_Comment)
VALUES('$bugid','$UserLoggedOn','$Comment')";

            if (mysqli_query($conn, $sql)) {
                echo "Comment added successfully";
                $Comment = "";
                header("Location: BugWithComments.php?bugid=$bugid");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
$conn->close();
?>
<br><br><br><br><br><br><br><br>

<?php include 'CommonFooter.php';?>
</body>
    </html>