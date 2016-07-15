<?php
/**
 * Created by PhpStorm.
 * User: Cambo
 * Date: 13/07/2016
 * Time: 16:25
 */

/** Setup Database Connection */
/** ==================================================================== */
$db = new mysqli(
    "eu-cdbr-azure-west-d.cloudapp.net",
    "b05411072e2e07",
    "2e5e5133",
    "1301070"
);

/?>
<!DOCTYPE html>
<html lang="en">
<title>SPLAT! Bug Catcher</title>
<meta charset="UTF-8">
<head>
    <title>SPLAT! Bug Catcher</title>
</head>
<body>
    <?php include 'CommonHeader.php';?>
    <?php include 'CommonLogin.php';?>
        <ul>
            <li><a href="http://1301070cameronbug.azurewebsites.net/production/useralbugs.php">Register (Page Not linked yet)</a></li>
        </ul>
    <?php include 'CommonFooter.php';?>
</body>
</html>