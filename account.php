<?php
	require 'header.inc.php';
?>
<!---login--->
<div class="content">
	<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
		  	  <form> 
				 <div class="register-top-grid">
					<h3>personal information</h3>
					 <div>
						<span>First Name<label>*</label></span>
						<input type="text"> 
					 </div>
					 <div>
						<span>Last Name<label>*</label></span>
						<input type="text"> 
					 </div>
					 <div>
						 <span>Email Address<label>*</label></span>
						 <input type="text"> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>login information</h3>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password">
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password">
							 </div>
					 </div>
				</form>
				<div class="clearfix"> </div>
				<div class="register-but">
				   <form>
					   <input type="submit" value="submit">
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
		 </div>
	</div>
<!-- registration -->

</div>
<!-- login -->
<?php
	require 'footer.inc.php';
?>
	