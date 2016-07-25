<?php
session_start();
echo 'Welcome '.$SESSION['username'];
echo '<br><a href="HomePage.php?action=logout">Logout</a>';
?>

