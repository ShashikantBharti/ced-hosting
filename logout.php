<?php
session_start();

unset($_SESSION['USER_ID']);
unset($_SESSION['IS_ADMIN']);

session_destroy();
header('location: ./login.php');

?>