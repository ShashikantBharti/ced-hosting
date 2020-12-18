<?php 
/**
 * Linux Hosting Page.
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
    require 'header.inc.php';
    $html = $query->getData(
        'tbl_product', ['html'], 
        ['id'=>2]
    );

    
    ?>
<!---singleblog--->
<div class="content">
    <div class="linux-section">
        <div class="container">
            <div class="linux-grids">
                <div class="col-md-8 linux-grid">
                <h2>CMS Hosting</h2>
                <ul>
                    <li><span>Unlimited </span> domains, email and disk space</li>
                    <li><span>99.9% uptime </span> with dedicated 24/7 technical support</li>
                    <li><span>1 click</span> WordPress Installation with cPanel (demo) platform</li>
                    <li><span>Launch  </span> your business with Rs. 1000* Google AdWords Credit *</li>
                    <li><span>30 day </span> Money Back Guarantee</li>
                </ul>
                    <a href="#">view plans</a>
                </div>
                <div class="col-md-4 linux-grid1">
                    <img src="images/cms.png" class="img-responsive" alt=""/>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="tab-prices">
        <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
                    <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">IN Hosting</a></li>
                    <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">US Hosting</a></li>
                    </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                        <div class="linux-prices">
                            <?php 
                            $query = new Query;
                            $id = $query->getSafeValue($_REQUEST['id']);
                            $data = $query->getDataFrom('tbl_product', 'tbl_product_description', ['id','prod_id'], '', '', ["tbl_product","prod_parent_id",$id]);
                            if($data == 0) {
                                echo 'No Data Available';
                            } else {
                                foreach ($data as $product) {
                                    $desc = (array)json_decode($product['description']);
                                ?>
                                <div class="col-md-3 linux-price">
                                    <div class="linux-top">
                                    <h4><?php echo $product['prod_name']; ?></h4>
                                    </div>
                                    <div class="linux-bottom">
                                        <h5>Rs. <?php echo $product['mon_price']; ?>/- <span class="month">per month</span></h5>
                                        <h6><?php echo $desc['free_domain']; ?> Domain</h6>
                                        <ul>
                                        <li><strong><?php echo $desc['web_space']; ?> GB</strong> Disk Space</li>
                                        <li><strong><?php echo $desc['band_width']; ?> GB</strong> Data Transfer</li>
                                        <li><strong><?php echo $desc['mail_box']; ?></strong> Email Accounts</li>
                                        <li><strong><?php echo $desc['technology']; ?></strong> <br>Tech-Support</li>
                                        <li><strong>Includes </strong>  Global CDN</li>
                                        <li><strong>High Performance</strong>  Servers</li>
                                        <li><strong>location</strong> : <img src="images/india.png"></li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0);" 
                                    onclick="manageCart(
                                        this,
                                        <?php echo $product['prod_id']; ?>,
                                        `<?php echo $product['sku']; ?>`,
                                        'add',
                                        `<?php echo $html[0]['html']; ?>`);
                                    ">Add Product</a>
                                </div>

                                <?php
                                }
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                    <div class="linux-prices">
                        <?php 
                            $query = new Query;
                            $id = $query->getSafeValue($_REQUEST['id']);
                            $data = $query->getDataFrom('tbl_product', 'tbl_product_description', ['id','prod_id'], '', '', ["tbl_product","prod_parent_id",$id]);
                            if($data == 0) {
                                echo 'No Data Available';
                            } else {
                                foreach($data as $product) {
                                    $desc = (array)json_decode($product['description']);
                                ?>
                                <div class="col-md-3 linux-price">
                                    <div class="linux-top us-top">
                                    <h4><?php echo $product['prod_name']; ?></h4>
                                    </div>
                                    <div class="linux-bottom us-bottom">
                                        <h5>$<?php echo $product['mon_price']; ?>/- <span class="month">per month</span></h5>
                                        <h6><?php echo $desc['free_domain']; ?> Domain</h6>
                                        <ul>
                                        <li><strong><?php echo $desc['web_space']; ?> GB</strong> Disk Space</li>
                                        <li><strong><?php echo $desc['band_width']; ?> GB</strong> Data Transfer</li>
                                        <li><strong><?php echo $desc['mail_box']; ?></strong> Email Accounts</li>
                                        <li><strong><?php echo $desc['technology']; ?></strong> <br>Tech-Support</li>
                                        <li><strong>Includes </strong>  Global CDN</li>
                                        <li><strong>High Performance</strong>  Servers</li>
                                        <li><strong>location</strong> : <img src="images/us.png"></li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0);" 
                                    onclick="manageCart(
                                        this,
                                        <?php echo $product['prod_id']; ?>,
                                        `<?php echo $product['sku']; ?>`,
                                        'add',
                                        `<?php echo $html[0]['html']; ?>`);
                                    ">Add Product</a>
                                </div>

                                <?php
                                }
                            }
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- clients -->
<div class="clients">
    <div class="container">
        <h3>Some of our satisfied clients include...</h3>
        <ul>
            <li><a href="#"><img src="images/c1.png" title="disney" /></a></li>
            <li><a href="#"><img src="images/c2.png" title="apple" /></a></li>
            <li><a href="#"><img src="images/c3.png" title="microsoft" /></a></li>
            <li><a href="#"><img src="images/c4.png" title="timewarener" /></a></li>
            <li><a href="#"><img src="images/c5.png" title="disney" /></a></li>
            <li><a href="#"><img src="images/c6.png" title="sony" /></a></li>
        </ul>
    </div>
</div>
<!-- clients -->
    <!-- Wordpress Features -->
    <div class="features">
        <div class="container">
            <h3>Wordpress Features</h3>
            <div class="features-grids">
                <div class="col-md-4 features-grid">
                    <img src="images/f1.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                    <div class="col-md-4 features-grid">
                        <img src="images/f2.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                    <div class="col-md-4 features-grid">
                        <img src="images/f3.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                <div class="clearfix"></div>
            </div>
            <div class="features-grids">
                <div class="col-md-4 features-grid">
                    <img src="images/f4.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                    <div class="col-md-4 features-grid">
                        <img src="images/f5.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                    <div class="col-md-4 features-grid">
                        <img src="images/f6.png">
                        <h4>Expert Web Design</h4>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
                    </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- Wordpress Features -->
</div>
<?php 
    require 'footer.inc.php';
?>