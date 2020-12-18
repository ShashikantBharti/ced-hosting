<?php
/**
 * Manage Cart.
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
require 'functions.inc.php';
$cart = new Cart;
switch($_REQUEST['type']) {

case 'add':
    $cart->addProduct($_REQUEST['id'], $_REQUEST['sku']);
    break;

case 'remove':
    $cart->removeProduct($_REQUEST['id']);
    break;

case 'empty':
    echo 'Empty';
    break;
}

echo $cart->totalProduct();

?>