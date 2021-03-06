<?php
/**
 * Login.
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
?>
<!---login--->
<div class="content">
    <div class="main-1">
        <div class="container">
            <?php  if ($message != '') {  ?>
                 <div class="alert <?php echo $className; ?> alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <?php echo $message; ?>
                </div>
            <?php } ?>
            <div class="login-page">
                <div class="account_grid">
                    <div class="col-md-6 login-left">
                         <h3>new customers</h3>
                         <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                         <a class="acount-btn" href="account.php">Create an Account</a>
                    </div>
                    <div class="col-md-6 login-right">
                        <h3>registered</h3>
                        <p>If you have an account with us, please log in.</p>
                        <form>
                          <div>
                            <span>Email Address<label>*</label></span>
                            <input type="text" name="username" required> 
                          </div>
                          <div>
                            <span>Password<label>*</label></span>
                            <input type="password" name="password" required> 
                          </div>
                          <a class="forgot" href="#">Forgot Your Password?</a>
                          <input type="submit" value="login" name="login">
                        </form>
                    </div>  
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login -->
<?php
    require 'footer.inc.php';
?>
