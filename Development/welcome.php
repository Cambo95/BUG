<?php
session_start();
echo 'Welcome '.$SESSION['username'];
echo '<br><a href="CommonLogin.php?action=logout">Logout</a>';
?>

