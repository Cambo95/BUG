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

?>

<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
<body>
<?php include 'CommonHeader.php';?>
<br><br><br>
Please title your bug and provide a description... 
<br><br>
<form action='' method="POST">
    Bug Title:<br>
    <input type ="text" name="Bug Title">
    <br>
    Description:<br>
    <input type="text" name="Description">
    <br>
    <input type ="submit" value ="submit">
</form>

<?php
$servername =  "eu-cdbr-azure-west-d.cloudapp.net";
$username = "b05411072e2e07";
$password = "2e5e5133";
$dbname = "1301070";
echo "At start of PHP";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])) {
echo "Submit button pressed<br>";
    $BugTitle = mysqli_real_escape_string($conn, $_POST['Bug Title']);
    $BugDescription = mysqli_real_escape_string($conn, $_POST['Description']);

if ($BugTitle == "" OR $BugDescription == "") {
echo "Bug Title and Description must be filled in to submit";
} else {
    echo "About to execute SQL<br>";
$sql = "INSERT INTO bug_instances(Inst_Title, Inst_Description)
VALUES('$BugTitle','$BugDescription')";
    echo $sql;
    echo "<br>";
if (mysqli_query($conn, $sql)) {
echo "Records added successfully";
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