<?php

require 'functions.inc.php';

$query = new Query;
$cart = new Cart;
switch($_REQUEST['type']) {
	case 'add':
		$id = $query->getSafeValue($_REQUEST['id']);
		$sku = $query->getSafeValue($_REQUEST['sku']);
		$cart->addProduct($id,$sku);
	break;

	case 'remove':
	break;

	case 'empty':
	break;
}

// echo $cart->totalProduct();
echo json_encode($_SESSION['CART']);


?>