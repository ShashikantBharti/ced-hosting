<?php
    require_once 'functions.inc.php';
  
    $query = new Query;
    $regMessage = '';
    $regClassName = '';
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] != '') {
    $firstName = $query->getSafeValue($_REQUEST['firstName']);
    $lastName = $query->getSafeValue($_REQUEST['lastName']);
    $mobile = $query->getSafeValue($_REQUEST['mobile']);
    $email = $query->getSafeValue($_REQUEST['email']);
    $password = $query->getSafeValue($_REQUEST['password']);
    $confirmPassword = $query->getSafeValue($_REQUEST['confirmPassword']);
    $securityQuestion = $query->getSafeValue($_REQUEST['securityQuestion']);
    $securityAnser = $query->getSafeValue($_REQUEST['securityAnser']);
    if ($password == $confirmPassword) {
        $password = md5($password);
        $name = $firstName.' '.$lastName;
        $result = $query->insertData('tbl_user', ["email"=>$email,"name"=>$name,"mobile"=>$mobile,"email_approved"=>0,"phone_approved"=>0,"active"=>0,"is_admin"=>0,"password"=>$password, "security_question"=>$securityQuestion,"security_answer"=>$securityAnser]);
        if ($result) {
            $result = $query->sendMail($email,$name,$result);
            if ($result) {
                $regMessage = "<strong>Registration successfull!</strong> Check your email!";
                $regClassName = "alert-success";
            } else {
                $regMessage = "OOPs Something went wrong!";
                $regClassName = "alert-danger";
            }

        } else {
            $regMessage = "Registration Failed!";
            $regClassName = "alert-danger";
        }
    }
}
  require 'header.inc.php';
?>
<!---login--->
<div class="content">
    <!-- registration -->
    <div class="main-1">
        <div class="container">
            <div class="register">
                <?php  if ($regMessage != ''):  ?>
                <div class="alert <?php echo $regClassName; ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-regMessage">
                            <?php echo $regMessage; ?>
                        </div>
                    </div>
                <?php endif; ?>
              <form action="" method="POST"> 
                 <div class="register-top-grid">
                    <h3>personal information</h3>
                     <div>
                        <span>First Name <label>*</label></span>
                        <input type="text" name="firstName" id="firstName" required> 
                        <span id="firstNameHelp" class="help-block"> </span>
                     </div>
                     <div>
                        <span>Last Name <label>*</label></span>
                        <input type="text" name="lastName" id="lastName" required> 
                        <span id="lastNameHelp" class="help-block"> </span>
                     </div>
                     <div>
                         <span>Mobile Number <label>*</label></span>
                         <input type="text" name="mobile" id="mobile" required> 
                         <span id="mobileHelp" class="help-block"> </span>
                     </div>
                     <div>
                         <span>Email Address <label>*</label></span>
                         <input type="text" name="email" id="email" required> 
                         <span id="emailHelp" class="help-block"> </span>
                     </div>
                     <div class="clearfix"> </div>
                       <a class="news-letter" href="#">
                         <label class="checkbox"><input type="checkbox" name="checkbox" value="1"><i> </i>Sign Up for Newsletter</label>
                       </a>
                     </div>
                     <div class="register-bottom-grid">
                            <h3>login information</h3>
                             <div>
                                <span>Password <label>*</label></span>
                                <input type="password" name="password" id="password" required>
                                <span id="passwordHelp" class="help-block"> </span>
                             </div>
                             <div>
                                <span>Confirm Password <label>*</label></span>
                                <input type="password" name="confirmPassword" id="confirmPassword" required> 
                                <span id="confirmPasswordHelp" class="help-block"> </span>
                             </div>
                     </div>
                     <div class="register-bottom-grid">
                        <h3>Security Information</h3>
                         <div class="has-error">
                            <span>Security Question ? <label>*</label></span>
                            <select name="securityQuestion" id="securityQuestion" class="form-control" required>
                                <option value="">Choose an option...</option>
                                <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                                <option value="What is the name of your favourite childhood friend?">What is the name of your favourite childhood friend?</option>
                                <option value="What was your favourite place to visit as a child?">What was your favourite place to visit as a child?</option>
                                <option value="What was your dream job as a child?">What was your dream job as a child?</option>
                                <option value="What is your favourite teacher's nickname?">What is your favourite teacher's nickname?</option>
                            </select>
                         </div>
                         <div>
                            <span>Security Anser ? <label>*</label></span>
                            <input type="password" name="securityAnser" id="securityAnser" required> 
                            <span id="securityAnserHelp" class="help-block"> </span>
                         </div>
                     </div>
                     

                     <button type="submit" name="submit" value="submit" class="register-btn">Submit</button>
                     
                </form>
                <p> * Mandatory fields.</p>
                <div class="clearfix"> </div>
           </div>
         </div>
    </div>
<!-- registration -->

</div>
<!-- login -->
<?php
    require 'footer.inc.php';
?>


    
