<?php
/**
 * Cart.
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

require_once 'header.inc.php';
$query = new Query;
$cart = new Cart;
?>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Hosting</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Monthly Price</th>
                <th>Annual Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $products = array();
        foreach ($_SESSION['CART'] as $key=>$value) {
            $sku = $value['sku'];
            $product = $query->getDataFrom(
                'tbl_product',
                'tbl_product_description',
                ['id','prod_id'], '', '',
                ['tbl_product_description', 'sku', $sku]
            );
            $products[] = $product;
        }
        $sr = 1;
        if (count($products) != 0) {
            foreach ($products as $product) {
                $desc = (array)json_decode($product[0]['description']);
                ?>
                <tr>
                    <td><?php echo $sr; ?></td>
                    <td>
                    <?php 
                    if ($product[0]['prod_parent_id'] == 2) {
                        echo 'Linux Hosting';
                    } elseif ($product[0]['prod_parent_id'] == 3) {
                        echo 'Windows Hosting';
                    } elseif ($product[0]['prod_parent_id'] == 4) {
                        echo 'Wordpress Hosting';
                    } else {
                        echo 'CMS Hosting';
                    }

                    ?>
                    </td>
                    <td><?php echo $product[0]['prod_name']; ?></td>
                    <td>
                        <ul>
                            <li>Web Space: 
                                <strong><?php echo $desc['web_space']; ?>GB</strong>
                            </li>
                            <li>Band Width: 
                                <strong><?php echo $desc['band_width']; ?>GB</strong>
                            </li>
                            <li>Free Domain: 
                                <strong><?php echo $desc['free_domain']; ?></strong>
                                </li>
                            <li>Mail Box: 
                                <strong><?php echo $desc['mail_box']; ?></strong>
                            </li>
                            <li>Technology support: 
                                <strong><?php echo $desc['technology']; ?></strong>
                            </li>
                        </ul>
                    </td>
                    <td>Rs.<?php echo $product[0]['mon_price']; ?>/-</td>
                    <td>Rs.<?php echo $product[0]['annual_price']; ?>/-</td>
                    <td>
                        <a 
                            href="javascript:void(0);" 
                            class="btn btn-danger" 
                            data-toggle="tooltip" 
                            data-placement="right" 
                            title="Remove"
                            onclick="removeProduct(
                                `<?php echo $product[0]['prod_id']; ?>`,
                                'remove',
                                );"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php
                $sr++;
            }
        } else {
            
            echo '
                <tr>
                    <td colspan="6" class="text-center">
                        <strong>No Product added in Cart</strong>
                    </td>
                </tr>';
        }
        ?>
            
        </tbody>
    </table>
    <div class="text-right">
        <a href="#" class="btn btn-primary btn-lg">Checkout</a>
        <a href="#" class="btn btn-danger btn-lg">Empty Cart</a>
    </div>
    <br>
    <br>
</div>
<?php
    require_once 'footer.inc.php';
?>