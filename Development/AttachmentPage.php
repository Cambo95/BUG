<?php

/** Resume the session to retrieve the parameters setup at login */
session_start();

/** =====================================================================================*/
/**
 * Created by PhpStorm.
 * User: Cambo
 *
 * PURPOSE : This is the Attachment Page - It allows the person who created a bug to select
 *           and upload attachments against the Bug they have created
 *
 * SECURITY : This page is only available to Users who are logged in
 */
/** =====================================================================================*/

/** Setup the SQL login credentials*/
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
/** ===============================================================================*/
?>

<!-- ============================================================================== -->
<!-- Set up the Tab name -->
<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
    <body>

    <!-- Bring in the common header script -->
<?php include 'CommonHeader.php';?>

    <!-- Set up a button to allow User to search for an object to be attached to the bug -->
    <!-- Set up a save button for User to press once file is selected  -->
<form action="" method="post" enctype="multipart/form-data">
<table border = "1" width = "80%">
    <tr>
        <th width = "50%">Upload Image</th>
        <td width = "50%"><input type ="file" name = "txt_image"</td>
    </tr>
    <tr>
        <td></td>
        <td><input type = "submit" name = "submit" value = "Save"></td>
    </tr>
</table>
</form>

    <!-- ============================================================================== -->
<?php

// Retrieve the BugUniqueID that the User selected in previous screen from the URL parameter
$buguniqueid=$_GET["buguniqueid"];


// If the User has pressed the SAVE button then check the size of the file to make sure it is not
// empty.  If its not empty then get the file name, size and type ready to save the object to
// the database. Retrieve the user name from the session and insert the object against that user
// into the table bug_attachment
$UserLoggedOn = $_SESSION["username"];
if ($UserLoggedOn !== '') {
    if (isset($_POST['submit'])) {
        if ($_FILES['txt_image']['size'] > 0) {

            $fileName = $_FILES['txt_image']['name'];
            $tmpName = $_FILES['txt_image']['tmp_name'];
            $fileSize = $_FILES['txt_image']['size'];
            $fileType = $_FILES['txt_image']['type'];

            $fp = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);
            fclose($fp);
            if (!get_magic_quotes_gpc()) {
                $fileName = addslashes($fileName);
            }
            $sql = "INSERT INTO bug_attachment(Att_BugUniqueID, Att_User, Att_Object, Att_Objectname, Att_Objecttype, Att_Objectsize)
            VALUES('$buguniqueid','$UserLoggedOn','$content','$fileName','$fileType','$fileSize')";
            if (mysqli_query($db, $sql)) {
                header("Location: BugWithComments.php?bugid=$buguniqueid");
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }
    }
}
$db->close();
?>

<br><br><br><br><br><br><br><br>

    <!-- Setup the footer  -->
<?php include 'CommonFooter.php';?>
    
    </body>
</html>

    