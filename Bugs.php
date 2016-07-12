<?php
define('DB_NAME', '1301070');
define('DB_USER', 'b05411072e2e07');
define('DB_PASSWORD','2e5e5133');
define('DB_HOST', 'eu-cdbr-azure-west-d.cloudapp.net');

$link = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);

if (!$link){
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME,$link);

if(!$db_selected){
    die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
}
echo 'Connected successfully';

/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 07/07/2016
 * Time: 16:00
 */
