<?php
/**
 * Create category page.
 * 
 * PHP version 7.*
 * 
 * @category  Functions.
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @version   GIT: <7.2>
 * @link      http://127.0.0.1/training/ced_hosting
 */

 require 'functions.inc.php';

 $query = new Query;
 $result = $query->getDataFrom('tbl_product', 'tbl_product_description', ['id','prod_id'], ["tbl_product","id",3]);
 echo '<pre>';
 print_r($result);