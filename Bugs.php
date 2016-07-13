<?php

echo " Start";
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
echo " About to do Test Connection";
//test connection
if($db->connect_errno){
    die('connection failed : '.$db->connect_error );

}
else echo "Test Connection Successful";

$sql_query = "SELECT com_comment FROM  bug_comments ";
// execute the SQL query
$result = $db->query($sql_query);

echo "Query Ran 2";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "comment: " . $row["com_comment"]. "<br>";
    }
} else {
    echo "0 results";
}
$db->close();

?>

