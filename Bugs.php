<?php

//echo " Start";
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);
$output = '';

if(isset($_POST['User'])){
   $searchq = $_POST['User'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searching);

    $sql_query = "SELECT * FROM  bug_comments WHERE Com_User LIKE '%$searchq%' OR Com_Comment LIKE '%$searchq%'";
    $count = mysqli_num_rows($query);
    if($count == 0){
      $output = 'There was no search results';
    }else{
        while($row = mysqli_fetch_array($query)){
            $username = $row['name'];
            $time = $row['date and time'];
            $comment = $row['comment'];

            $output .= '<div>'.$username.''.$time.''.$comment.'</div>';
        }
    }
// execute the SQL query
    $result = $db->query($sql_query);
}

if($db->connect_errno){
    die('connection failed : '.$db->connect_error );

}




?>

<html>
<head>
    <title>Bug Site</title>
</head>
<body>
<form action ="bugs.php" method="post">
    <input type="text" name="search" placeholder="Search for comments..."/>
    <input type="submit" value=">>"/>
<?php print ("$output");?>




</form>
</body>
</html>