<?php

require 'functions.inc.php';

$query = new Query;

$result = $query->getDataFrom('tbl_product','tbl_product_description',["id","prod_id"],'','',["tbl_product","id",14]);
echo '<pre>';
print_r($result);