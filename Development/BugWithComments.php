<?php

/** Resume the session to retrieve the parameters setup at login */
session_start();


/** =====================================================================================*/
/**
 * Created by PhpStorm.
 * User: Cambo
 *
 * PURPOSE  : This is the page for a single bug showing the details of that bug AND
 *            all the comments linked to that bug.  Comments are added on this page.
 *            Existing comments can be deleted from this page too 
 *            Also the Bug can be flagged as Fixed or Unfixed on this page.
 * SECURITY : This page is available to Public/Developers/Admin.
 *            Add Comments is only available to Developers/Admin (must be logged in)
 *            The Fixed/Unfixed button is only shown if the person logged in is also the
 *            creator of the Bug.
 *            Comments can be deleted by Admin users.
 *            Comments can be deleted by the creator of the comment.
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);

/** Retrieve the bugid from the URL parameter */
$bugid=$_GET["bugid"];
/** Retrieve from the session whether the user logged in is an administrator */
$isadmin = $_SESSION['isadmin'];

/** Setup the SQL statement */
$sql_query = "SELECT * FROM bug_instances WHERE Inst_BugUniqueID = $bugid";

/** Retrieve the record from the table */
$result = $db->query($sql_query);

$sqlrow   = mysqli_fetch_assoc($result);
$bugbug   = $sqlrow['Inst_BugUniqueID'];
$bug      = $sqlrow['Inst_Title'];
$describe = $sqlrow['Inst_Description'];
$user     = $sqlrow['Inst_User'];
$date     = $sqlrow['Inst_DatePosted'];
$datefixed= $sqlrow['Inst_DateFixed'];

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
    echo "<td>" . $bugbug."</td>";
?>
<br>
<h5>Title:</h5> <?php
    echo "<td>" . $bug."</td>";  echo "</tr>";
?>
<br>
<h5>Description:</h5> <?php
    echo "<td>" . $describe."</td>";
?>
<br>
<h5>User:</h5> <?php
    $buguser=$User;
    $UserLoggedOn = $_SESSION["username"];
    echo "<td>" . $user."</td>";
?>
<br>
<h5>Date Posted:</h5> <?php
    echo "<td>" . $date . "</td>";
?>
<br>
<h5>Date Fixed:</h5> <?php
    if ($datefixed){
        echo "Bug was Fixed on ";
        echo $datefixed;
        $bugfixed ='Y';
        $buttontext = 'Flag as Unfixed';
    }
    if (!$datefixed){
        echo "Bug is currently unfixed";
        $bugfixed ='N';
        $buttontext = 'Flag as Fixed';
    }
?>
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
<?php

if ($buguser ==$UserLoggedOn ) {
    echo "<td>" . '<a href="AttachmentPage.php?bugid='.$bugid.'&comuser='.$buguser.'">Add Attachment</a>'."</td>"; 
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
        echo "<td>" . '<a href="DeleteSingleComments.php?bugid='.$bugid.'&comuser='.$comuser.'&comdatetime='.$comdatetime.'">Delete</a>'."</td>";
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