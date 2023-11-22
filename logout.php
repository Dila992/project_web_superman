<?php
session_start();
session_destroy();
header("Location: login.php"); 
// redirect ke halaman login
exit();
?>
