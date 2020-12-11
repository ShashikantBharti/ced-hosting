<?php
require '../functions.inc.php';

$query = new Query;

$message = '';
$className = '';
$action = 'add';

if(isset($_REQUEST['product']) and $_REQUEST['product'] != '') {
	switch($_REQUEST['product']) {
		case 'add':
			// tbl_product
			$category = $query->getSafeValue($_REQUEST['category']);
			$prodName = $query->getSafeValue($_REQUEST['prodName']);
			$URL = $query->getSafeValue($_REQUEST['url']);
			$isAvailable = $query->getSafeValue($_REQUEST['isAvailable']);
			// tbl_product_description
			$monthlyPrice = $query->getSafeValue($_REQUEST['monthlyPrice']);
			$annualPrice = $query->getSafeValue($_REQUEST['annualPrice']);
			$sku = $query->getSafeValue($_REQUEST['sku']);
			// as json strong in description
			$webSpace = $query->getSafeValue($_REQUEST['webSpace']);
			$bandWidth = $query->getSafeValue($_REQUEST['bandWidth']);
			$freeDomain = $query->getSafeValue($_REQUEST['freeDomain']);
			$mailBox = $query->getSafeValue($_REQUEST['mailBox']);
			$technology = $query->getSafeValue($_REQUEST['technology']);
			// Description
			$desc = array("web_space"=>$webSpace,"band_width"=>$bandWidth,"free_domain"=>$freeDomain,"mail_box"=>$mailBox,"technology"=>$technology);
			$desc = json_encode($desc);
			
			$result = $query->insertData('tbl_product',["prod_parent_id"=>$category,"prod_name"=>$prodName,"link"=>$URL,"prod_available"=>$isAvailable,]);

			if($result) {
				$deleteId = $result;
				$result = $query->insertData('tbl_product_description',["prod_id"=>$result,"description"=>$desc,"mon_price"=>$monthlyPrice,"annual_price"=>$annualPrice,"sku"=>$sku]);
				if($result) {
					$message = '<strong>New Product</strong> Added succesfully!';
					$className = 'alert-success';
				} else {
					$message = '<strong>New Product</strong> Addition in second table Failed!';
					$className = 'alert-danger';
					$query->deleteData('tbl_product',["id"=>$deleteId]);
				}
			} else {
				$message = '<strong>New Product</strong> Addition Failed!';
				$className = 'alert-danger';
			}


		break;
		case 'edit':
		
		break;
		case 'update':
		break;
		case 'delete':
		break;
	}
}


require 'header.inc.php';
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Add Product</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<?php if($message != ''): ?>
						<div class="alert <?php echo $className; ?> alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
							<div class="alert-message">
								<?php echo $message; ?>
							</div>
						</div>
					<?php endif; ?>
					</div>
					<div class="card-body mt-n4">
						<form method="POST" action="">
							<h4 class="mt-2">Create New Product</h4>
							<h5 class="card-title">Enter Product Details</h5>
							<select class="custom-select mb-3" name="category">
								<option value="">Select Product Category...</option>
								<?php  
									$result = $query->getData('tbl_product','',["prod_parent_id"=>1,"prod_available"=>1]);
									if($result != 0) {
										foreach($result as $category) {
									?>
										<option value="<?php echo $category['id']; ?>"><?php echo $category['prod_name']; ?></option>
									<?php  

										}
									} else {
										echo 'No Record Found!';
									}
								
								?>
							</select>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="prodName">Product Name*</label>
									<input type="text" class="form-control" id="prodName" placeholder="Enter Product Name..." name="prodName">
								</div>
								<div class="form-group col-md-6">
									<label for="pageURL">Page URL</label>
									<input type="text" class="form-control" id="pageURL" placeholder="Enter Page URL..." name="url">
								</div>
							</div>
							<h4 class="mt-4">Product Description</h4>
							<h5 class="card-title">Enter Product Description Below</h5>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="monthlyPrice">Monthly Price*</label>
									<input type="text" class="form-control" id="monthlyPrice" placeholder="Enter Monthly Price..." name="monthlyPrice">
								</div>
								<div class="form-group col-md-6">
									<label for="annualPrice">Annual Price*</label>
									<input type="number" class="form-control" id="annualPrice" placeholder="Enter Annual Price..." name="annualPrice">
								</div>
							</div>
							<div class="form-group">
								<label for="sku">SKU*</label>
								<input type="text" class="form-control" id="sku" placeholder="Enter Stock Keeping Unit..." name="sku">
							</div>
							<h4 class="mt-4">Features</h4>
							<h5 class="card-title">Enter Product Features</h5>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="webSpace">Web Space (in GB)*</label>
									<input type="text" class="form-control" id="webSpace" placeholder="Enter Web Space (in GB)..." name="webSpace">
								</div>
								
								<div class="form-group col-md-6">
									<label for="bandWidth">Band Width (in GB)*</label>
									<input type="text" class="form-control" id="bandWidth" placeholder="Enter Bandwidth (in GB)..." name="bandWidth">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="freeDomain">Free Domain*</label>
									<input type="text" class="form-control" id="freeDomain" placeholder="Number of free domain..." name="freeDomain">
								</div>
								
								<div class="form-group col-md-6">
									<label for="mailBox">Mail Box*</label>
									<input type="text" class="form-control" id="mailBox" placeholder="Enter number of mailbox..." name="mailBox">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="technology">Language/Technology Support*</label>
									<input type="text" class="form-control" id="technology" placeholder="Number of free domains..." name="technology">
								</div>
								<div class="form-group col-md-6 pt-1">
									<select class="custom-select mt-4" name="isAvailable">
										<option value="">Is Available...</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
								
							</div>
							<button type="submit" name="product" value="<?php echo $action; ?>" class="btn btn-block btn-primary"><?php echo ucfirst($action); ?></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
require 'footer.inc.php';
?>

</body>
</html>