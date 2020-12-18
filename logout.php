<?php
/**
 * Logout for user.
 * 
 * PHP version 7
 * 
 * @category  Services.
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @version   GIT: <1.0>
 * @link      http://127.0.0.1/training/ced_hosting
 */
session_start();

unset($_SESSION['USER_ID']);
unset($_SESSION['IS_ADMIN']);

session_destroy();
header('location: ./login.php');

?>