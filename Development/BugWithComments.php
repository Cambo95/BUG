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

/** load up the display variables */
$bugbug   = $sqlrow['Inst_BugUniqueID'];
$bug      = $sqlrow['Inst_Title'];
$describe = $sqlrow['Inst_Description'];
$user     = $sqlrow['Inst_User'];
$userReportedBy = $sqlrow['Inst_ReportedBy'];
$date     = $sqlrow['Inst_DatePosted'];
$datefixed= $sqlrow['Inst_DateFixed'];
$UserLoggedOn = $_SESSION["username"];

?>
<?php include 'CommonHeader.php';?>
    <html>
<head>
    <style>

        h4{
            color: #ff0000;
        }
        h5{
            color: #008080;
        }
    </style>
</head>
<body>
<br>
<h4>Bug Details</h4>
<?php
if($UserLoggedOn == $user) {
    echo "<td>" . '<a href="EditBug.php?bugid=' . $bugbug . '">Edit Bug</a>' . "</td>";
}
echo "<br>";
if($isadmin == 1){
    echo "<td>" . '<a href="DeleteBug.php?bugid=' . $bugbug . '">Delete Bug</a>' . "</td>";
}
?>

<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>Bug ID</th>
        <th>Title</th>
        <th>User</th>
        <th>Reported By</th>
        <th>Date Posted</th>
        <th>Date Fixed</th>
    </tr>
    <!-- Process through all the retrieved rows and display on screen -->
    <!-- Setup a link field with the title 'Verify User' to allow Admin to select user for verification -->
    <!-- The link field has a URL parameter called verifyusername and the User name is -->
    <!-- concatenated to the URL so that when Admin clicks on the link it calls Verify.PHP and -->
    <!-- passes the User name through to that php -->
    <?php
    echo "<tr>";
    echo "<td>" .$bugbug."</td>";
    echo "<td>" .$bug."</td>";
    echo "<td>" .$user."</td>";
    echo "<td>" .$userReportedBy."</td>";
    echo "<td>" .$date."</td>";
    echo "<td>" .$datefixed."</td>";
    echo "</tr>";
    ?>
</table>
<br>
<h5>Description:</h5> <?php
    echo $describe;
?>
<br><br><br>
<!-- If the date fixed field is not empty that means the bug is fixed.  Setup the button   -->
<!-- text to say FLAG AS UNFIXED so that user can set the bug status to UNFIXED -->
<!-- If the date fixed field IS emptythat means the bug is NOT fixed.  Setup the button   -->
<!-- text to say FLAG AS FIXED so that user can set the bug status to FIXED -->
<?php
    if ($datefixed){
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


<!-- If the person logged on is also the person who created the bug then display the  -->
<!-- Fix/Unfix button  -->
<?php if($user == $UserLoggedOn): ?>
<form action='' method="POST">
    <input type="submit" name="Fixed" value = "<?php echo $buttontext;?>">
</form>
<?php endif; ?>


<?php

/** If the person logged on is also the person who created the bug AND */
/** they pressed the button then toggle the Inst_DateFixed */
if ($user ==$UserLoggedOn ) {
    
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
<br>

<!-- Setup the Comments table headers then display all rows retrieved -->
<!-- At the end of each row put a DELETE link to allow user to delete that comment  -->
<!-- If the DELETED is clicked then the record key fields are passed in the URL to  -->
<!-- DeleteSingleComments.php which will check that the person trying to delete  -->
<!-- the comment is the person who created it - if they arent the same they wont be -->
<!-- able to delete the comment  -->




<h4>Comments</h4>
<!-- If the User is logged on then display the Add Comments box and button  -->
<?php if($UserLoggedOn!==''): ?>
    <?php    echo "<td>" . '<a href="AddComment.php?bugid='.$bugid.'">Add Comment</a>'."</td>"; ?>
<?php endif; ?>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>User</th>
        <th>Date+Time posted</th>
        <th>Comment</th>
        <th></th>
    </tr>
    <?php

    /** Retriev all the comments rows into resultsComments ready for display further down */
    $sql_queryComments = "SELECT * FROM bug_comments WHERE Com_BugUniqueID = $bugid ORDER BY Com_DateTime DESC limit 50";
    //$resultComments = $db->query($sql_queryComments);
    $resultComments = mysqli_query($db,$sql_queryComments );


  //  while($Comment = mysqli_fetch_assoc($resultComments)) {
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

<?php
echo "<td>" . '<a href="DeleteAllComments.php?bugid='.$bugid.'">Delete All Comments</a>'."</td>";
/** Retrieve the BUG ID  from the URL parameter */
$bugid=$_GET["bugid"];

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

/** Retrieve all the attachments rows into resultsCAttachments ready for display further down */
$sql_queryAttachments = "SELECT * FROM bug_attachment WHERE Att_BugUniqueID = $bugid ORDER BY Att_DateTime DESC limit 50";
$resultAttachments = $db->query($sql_queryAttachments);
?>

<!-- Setup the Attachment table headers then display all rows retrieved -->
<!-- At the end of each row put a DELETE link to allow user to delete that attachment  -->
<!-- If the DELETED is clicked then the record key fields are passed in the URL to  -->
<!-- DeleteSingleAttachment.php which will check that the person trying to delete  -->
<!-- the attachment is the person who created it - if they arent the same they wont be -->
<!-- able to delete the attachment  -->

<h4>Attachments</h4>
<?php

/** If the person logged on is also the person who created the bug then */
/** display the Add Attachment link to allow bug creator to upload an attachment */
if ($user ==$UserLoggedOn ) {
    echo "<td>" . '<a href="AttachmentPage.php?buguniqueid='.$bugid.'&comuser='.$user.'">Add Attachment</a>'."</td>";
}
?>
<table class="w3-table w3-bordered w3-striped">
    <tr class="w3-teal">
        <th>User</th>
        <th>Date+Time posted</th>
        <th>Attachment name</th>
        <th>Attachment type</th>
        <th>Attachment size</th>
        <th></th>
    </tr>
    <?php
    while($Attachments = mysqli_fetch_assoc($resultAttachments)) {
        echo "<tr>";
        $attuser = $Attachments['Att_User'];
        $attdatetime = $Attachments['Att_DateTime'];
        $attobjname = $Attachments['Att_Objectname'];
        $attobjtype = $Attachments['Att_Objecttype'];
        $attobjsize = $Attachments['Att_Objectsize'];


        echo "<td>" . $attuser."</td>";
        echo "<td>" . $attdatetime."</td>";
        echo "<td>" . $attobjname."</td>";
        echo "<td>" . $attobjtype."</td>";
        echo "<td>" . $attobjsize."</td>";
     
        echo "<td>" . '<a href="DeleteSingleAttachment.php?bugid='.$bugid.'&attuser='.$attuser.'&attdatetime='.$attdatetime.'">Delete</a>'."</td>";
        echo "</tr>";
    }//end while
    ?>
</table>
<!-- If the user logged on is an admin ulser then display the Delete All Attachments button  -->
<?php echo "<td>" . '<a href="DeleteAllAttachments.php?bugid='.$bugid.'">Delete All Attachments</a>'."</td>"; ?>
<br><br>
<!-- Display the common Footer  -->
<?php include 'CommonFooter.php';?>
</body>
    </html>