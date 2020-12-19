<?php
/**
 * Checkout.
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
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div id="login">
                <h4 class="bg-danger" style="padding:10px; margin-bottom: 10px;">
                    User Login
                </h4>
                <form action="">
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" name="username" 
                        id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" 
                        id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <div id="shipping-address">
                <h4 class="bg-danger" style="padding:10px; margin-bottom: 10px;">
                    Shipping Address
                </h4>
                <form action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" 
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" 
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" 
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pin Code</label>
                        <input type="text" name="pincode" id="pincode" 
                        class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Payment Method</label> <br>
                        <input type="radio" name="payment" id="payment">
                        <label for="payment">COD</label> &nbsp;
                        <input type="radio" name="payment" id="upi">
                        <label for="upi">UPI</label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-block">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div id="order-details">
                <h4 class="bg-danger" style="padding: 10px; margin-bottom: 10px;">
                    Order Details
                </h4>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Sr</th>
                            <th>Hosting</th>
                            <th>Product Name</th>
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
                        $amount = 0;
                        foreach ($products as $product) {
                            $amount += $product[0]['annual_price'];
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
                                    Rs.<?php echo $product[0]['annual_price']; ?>/-
                                </td>
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
                        echo "<tr class='h4'>
                                <td colspan='3'><strong>Total Amount : </strong></td>
                                <td colspan='3'><strong>Rs. $amount/-</strong></td>
                            </tr>
                            <tr class='h4'>
                                <td colspan='3'><strong>Discount : </strong></td>
                                <td colspan='3'><strong>Rs. 0/-</strong></td>
                            </tr>
                            <tr class='h3'>
                                <td colspan='3'><strong>Grand Total : </strong></td>
                                <td colspan='3'><strong>Rs. $amount/-</strong></td>
                            </tr>";
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
                <!-- <div class="bg-warning" style="padding: 15px; margin: 30px 0">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing 
                            elit. Provident eos voluptatum delectus ipsam illo 
                            non mollitia repellat voluptates at. Amet quod 
                            rerum facere nostrum voluptatibus dicta fuga ullam 
                            natus illum.
                            <a href="#">Read More...</a>
                        </p>
                    </div> -->
            </div>
        </div>
    </div>
</div>

<?php 
    require_once 'footer.inc.php';
?>