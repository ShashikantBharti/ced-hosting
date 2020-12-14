<?PHP
session_start();	

if(isset($_SESSION['USER_ID'])) {
	if ($_SESSION['IS_ADMIN'] == 1) {
		header('location: ./admin/');
	}
}

require_once 'functions.inc.php';
$url = basename($_SERVER['REQUEST_URI']);

$query = new Query;
   $message = '';
   $className = '';

if (isset($_REQUEST['varify']) and base64_decode($_REQUEST['varify']) == 'email') {
	$id = base64_decode($_REQUEST['id']);
	$data = $query->getData('tbl_user','',["id"=>$id]);
	if($data[0]['active'] == 1){
		$message = '<strong>Already Verified</strong> You can Login!';
		$className = 'alert-success';
	} else {
		$result = $query->updateData('tbl_user',["email_approved"=>1,"active"=>1],["id"=>$id]);
		if($result) {
			$message = '<strong>Activated</strong> Now You can Login!';
			$className = 'alert-success';
		}
	}

}

if (isset($_REQUEST['login']) && $_REQUEST['login'] != '') {
    
    $username = $query->getSafeValue($_REQUEST['username']);
    $password = $query->getSafeValue($_REQUEST['password']);

    $user = $query->getData('tbl_user', '', ["email"=>$username]);
        
    if ($user != 0) {
    	if($user[0]['active'] == 1) {
	        if (md5($password) == $user[0]['password']) {
	            $_SESSION['USER_ID'] = $user[0]['id'];
	            $_SESSION['IS_ADMIN'] = $user[0]['is_admin'];
	            if ($_SESSION['IS_ADMIN'] == 1) {
	                header('location: ./admin/');
	            } else {
	                header('location: ./');
	            }
	        } else {
	            $message = '<strong>Login Failed!</strong> Password is Incorrect!';
	            $className = 'alert-danger';
	        }
	    } else {
	    	$result = $query->sendMail($username,$user[0]['name'],$user[0]['id']);
	    	if($result) {
	    		$name = base64_encode($user[0]['name']);
	    		$id = base64_encode($user[0]['id']);
		    	$message = '<strong>You are not active user!</strong> activation link has sent to your email:'.$username.' please varify email! <p>Email Not recieved ?<a href="?action=sendmail&username='.base64_encode($username).'&name='.$name.'&id='.$id.'">Resend Email</a></p>';
	            $className = 'alert-warning';
	        } else {
	        	$message = 'OOPs something went wrong!';
	            $className = 'alert-danger';
	        }
	    }
    } else {
        $message = '<strong>Login Failed!</strong> User not exists!';
        $className = 'alert-danger';
    }
}
if(isset($_REQUEST['action']) and $_REQUEST['action'] != '') {
	if($_REQUEST['action'] == 'sendmail') {
		$username = base64_decode($_REQUEST['username']);
		$name = base64_decode($_REQUEST['name']);
		$id = base64_decode($_REQUEST['id']);
		$result = $query->sendMail($username,$name,$id);
    	if($result) {
    		$name = base64_encode($name);
    		$id = base64_encode($id);
	    	$message = ' activation link has sent to your email: <strong>'.$username.'</strong> please varify email! <p>Email Not recieved? <a href="?action=sendmail&username='.base64_encode($username).'&name='.$name.'&id='.$id.'">Resend Email</a></p>';
            $className = 'alert-warning';
        } else {
        	$message = 'OOPs something went wrong!';
            $className = 'alert-danger';
        } 
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Ced Hosting | Best Hosting Service in INDIA</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!---fonts-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link href='https://fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!---fonts-->
<!--script-->
<script src="js/modernizr.custom.97074.js"></script>
<script src="js/jquery.chocolat.js"></script>
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<!--lightboxfiles-->


<?php

if($url == 'account.php' || $url == 'contact.php' || $url == 'linuxhosting.php' || $url == 'wordpresshosting.php' || $url == 'windowshosting.php' || $url == 'cmshosting.php' || $url == 'login.php' || $url == 'pricing.php' || $url == 'blog.php') {
?>
<!--script-->
<link rel="stylesheet" href="css/swipebox.css">
<script src="js/jquery.swipebox.min.js"></script> 
	<script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
<!--script-->
<?php
}
if($url == 'index.php' || $url == 'ced_hosting' || $url == 'about.php' || $url == 'services.php') {
?>
<!--lightboxfiles-->
<script type="text/javascript">
	$(function() {
	$('.team a').Chocolat();
	});
</script>	
<script type="text/javascript" src="js/jquery.hoverdir.js"></script>	
<script type="text/javascript">
	$(function() {
	
		$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

	});
</script>						
<!--script-->

<?php 
}
?>

</head>
<body>
	<!---header--->
		<div class="header">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<i class="sr-only">Toggle navigation</i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
								<i class="icon-bar"></i>
							</button>				  
							<div class="navbar-brand">
								<h1><a href="index.php">Ced <span>Hosting</span></a></h1>
							</div>
						</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php if($url=='index.php' || $url=='ced_hosting'){ echo 'active'; } ?>"><a href="index.php">Home <i class="sr-only">(current)</i></a></li>
								<li class="<?php if($url=='about.php'){ echo 'active'; } ?>"><a href="about.php">About</a></li>
								<li class="<?php if($url=='services.php'){ echo 'active'; } ?>"><a href="services.php">Services</a></li>
								<?php 
								if($url == 'linuxhosting.php' || $url == 'wordpresshosting.php' || $url == 'windowshosting.php' || $url == 'cmshosting.php') {
									$active = "active";
								} else {
									$active = '';
								}

								?>
								<li class="dropdown <?php echo $active; ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hosting<i class="caret"></i></a>
									<ul class="dropdown-menu">
										<?php
											$result = $query->getData('tbl_product','',["prod_parent_id"=>1,"prod_available"=>1]);
											if($result != 0){
												foreach($result as $link){
													?>
													<li>
														<a href="<?php echo $link['link']; ?>"><?php echo $link['prod_name']; ?></a>
													</li>
													<?php
												}
											} else {
												echo 'No Record Found!';
											}
										?>
									</ul>			
								</li>
								<li class="<?php if($url=='pricing.php'){ echo 'active'; } ?>"><a href="pricing.php">Pricing</a></li>
								<li class="<?php if($url=='blog.php'){ echo 'active'; } ?>"><a href="blog.php">Blog</a></li>
								<li class="<?php if($url=='contact.php'){ echo 'active'; } ?>"><a href="contact.php">Contact</a></li>
								<?php 
									if(isset($_SESSION['USER_ID']) && $_SESSION['IS_ADMIN'] == 0) {

										?>
										<li class=""><a href="logout.php">Logout</a></li>

										<?php

									} else {
										?>
										<li class="<?php if($url=='login.php'){ echo 'active'; } ?>"><a href="login.php">Login/Register</a></li>
										<?php
									}
								?>
								<li class="<?php if($url=='cart.php'){ echo 'active'; } ?>"><a href="cart.php">Cart<i class="fas fa-shopping-cart"></i></a></li>
							</ul>
									  
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>
	<!---header--->
