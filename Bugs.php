<?php
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
