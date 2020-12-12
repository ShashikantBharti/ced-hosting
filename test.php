<?php

require 'functions.inc.php';

$query = new Query;

$result = $query->getDataFrom('tbl_product','tbl_product_description',["id","prod_id"],["id","prod_parent_id","prod_name"]);