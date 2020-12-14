<?php
require '../functions.inc.php';

$query = new Query;

$message = '';
$className = '';
$action = 'add';

$cat = '';
$prodName = '';
$isAvailable = '';
// tbl_product_description
$monthlyPrice = '';
$annualPrice = '';
$sku = '';
// as json strong in description
$webSpace = '';
$bandWidth = '';
$freeDomain = '';
$mailBox = '';
$technology = '';

if(isset($_REQUEST['product']) and $_REQUEST['product'] != '') {
	switch($_REQUEST['product']) {
		case 'add':
			// tbl_product
			$category = $query->getSafeValue($_REQUEST['category']);
			$prodName = $query->getSafeValue($_REQUEST['prodName']);
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
			
			$result = $query->insertData('tbl_product',["prod_parent_id"=>$category,"prod_name"=>$prodName,"prod_available"=>$isAvailable,]);

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

			// Reset Values;
			$cat = '';
			$prodName = '';
			$link = '';
			$isAvailable = '';
			// tbl_product_description
			$monthlyPrice = '';
			$annualPrice = '';
			$sku = '';
			// as json strong in description
			$webSpace = '';
			$bandWidth = '';
			$freeDomain = '';
			$mailBox = '';
			$technology = '';



		break;
		case 'edit':
			$action = 'update';
			$id = $_REQUEST['id'];
			$data = $query->getDataFrom('tbl_product','tbl_product_description',["id","prod_id"],'','',["tbl_product","id",$id]);

			// Set Values.
			$cat = $data[0]['prod_parent_id'];
			$prodName = $data[0]['prod_name'];
			$isAvailable = $data[0]['prod_available'];
			// tbl_product_description
			$monthlyPrice = $data[0]['mon_price'];
			$annualPrice = $data[0]['annual_price'];
			$sku = $data[0]['sku'];
			// as json strong in description
			$desc = (array)json_decode($data[0]['description']);
			$webSpace = $desc['web_space'];
			$bandWidth = $desc['band_width'];
			$freeDomain = $desc['free_domain'];
			$mailBox = $desc['mail_box'];
			$technology = $desc['technology'];

			
		break;
		case 'update':
			// tbl_product
			$id = $query->getSafeValue($_REQUEST['id']);
			$category = $query->getSafeValue($_REQUEST['category']);
			$prodName = $query->getSafeValue($_REQUEST['prodName']);
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

			$result = $query->updateData('tbl_product',["prod_parent_id"=>$category,"prod_name"=>$prodName,"prod_available"=>$isAvailable],["id"=>$id]);
			if($result) {
				$result = $query->updateData('tbl_product_description',["description"=>$desc,"mon_price"=>$monthlyPrice,"annual_price"=>$annualPrice,"sku"=>$sku],["prod_id"=>$id]);
				if($result) {
					header('location: view-products.php?update_status=1');
				} else {
					$message = '<strong>Product Updation</strong> in second table Failed!';
					$className = 'alert-danger';
				}
			} else {
				$message = '<strong>Product Updation</strong> Failed!';
				$className = 'alert-danger';
			}


		// Reset Values;
		$cat = '';
		$prodName = '';
		$URL = '';
		$isAvailable = '';
		// tbl_product_description
		$monthlyPrice = '';
		$annualPrice = '';
		$sku = '';
		// as json strong in description
		$webSpace = '';
		$bandWidth = '';
		$freeDomain = '';
		$mailBox = '';
		$technology = '';

		break;
		
	}
}


require 'header.inc.php';
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><?php echo ucfirst($action); ?> Product</h1>
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
						<form method="POST" action="" id="prod-form">
							<h4 class="mt-2">Create New Product</h4>
							<h5 class="card-title">Enter Product Details</h5>
							<select class="custom-select" name="category" id="category">
								<option value="">Select Product Category...</option>
								<?php  
									$result = $query->getData('tbl_product','',["prod_parent_id"=>1,"prod_available"=>1]);
									if($result != 0) {
										foreach($result as $category) {
									?>
										<option <?php if($cat != '' and $cat == $category['id']){echo 'selected'; }  ?> value="<?php echo $category['id']; ?>"><?php echo $category['prod_name']; ?></option>
									<?php  

										}
									} else {
										echo 'No Record Found!';
									}
								
								?>
							</select>
							<span class="help-block"></span>
							<div class="form-row mt-3">
								<div class="form-group col-md-12">
									<label for="prodName">Product Name*</label>
									<input type="text" class="form-control" id="prodName" placeholder="Enter Product Name..." name="prodName" value="<?php echo $prodName; ?>">
									<span class="help-block"></span>
								</div>
							</div>
							<h4 class="mt-4">Product Description</h4>
							<h5 class="card-title">Enter Product Description Below</h5>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="monthlyPrice">Monthly Price*</label>
									<input type="text" class="form-control" id="monthlyPrice" placeholder="Enter Monthly Price..." name="monthlyPrice" value="<?php echo $monthlyPrice; ?>">
									<span class="help-block"></span>
								</div>
								<div class="form-group col-md-6">
									<label for="annualPrice">Annual Price*</label>
									<input type="text" class="form-control" id="annualPrice" placeholder="Enter Annual Price..." name="annualPrice" value="<?php echo $annualPrice; ?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<label for="sku">SKU*</label>
								<input type="text" class="form-control" id="sku" placeholder="Enter Stock Keeping Unit..." name="sku" value="<?php echo $sku; ?>">
								<span class="help-block"></span>
							</div>
							<h4 class="mt-4">Features</h4>
							<h5 class="card-title">Enter Product Features</h5>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="webSpace">Web Space (in GB)*</label>
									<input type="text" class="form-control" id="webSpace" placeholder="Enter Web Space (in GB)..." name="webSpace" value="<?php echo $webSpace; ?>">
									<span class="help-block"></span>
								</div>
								
								<div class="form-group col-md-6">
									<label for="bandWidth">Band Width (in GB)*</label>
									<input type="text" class="form-control" id="bandWidth" placeholder="Enter Bandwidth (in GB)..." name="bandWidth" value="<?php echo $bandWidth; ?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="freeDomain">Free Domain*</label>
									<input type="text" class="form-control" id="freeDomain" placeholder="Number of free domain..." name="freeDomain" value="<?php echo $freeDomain; ?>">
									<span class="help-block"></span>
								</div>
								
								<div class="form-group col-md-6">
									<label for="mailBox">Mail Box*</label>
									<input type="text" class="form-control" id="mailBox" placeholder="Enter number of mailbox..." name="mailBox" value="<?php echo $mailBox; ?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="technology">Language/Technology Support*</label>
									<input type="text" class="form-control" id="technology" placeholder="Language and Technology supported..." name="technology" value="<?php echo $technology; ?>">
									<span class="help-block"></span>
								</div>
								<div class="form-group col-md-6 pt-1">
									<select class="custom-select mt-4" name="isAvailable" id="isAvailable">
										<option value="">Is Available...</option>
										<option <?php if($isAvailable != '' and $isAvailable == 1){ echo 'selected'; } ?> value="1">Yes</option>
										<option  <?php if($isAvailable != '' and $isAvailable == 0){ echo 'selected'; } ?> value="0">No</option>
									</select>
									<span class="help-block"></span>
								</div>
								
							</div>
							<input type="hidden" name="id" value="<?php echo isset($id)?$id:'0'; ?>">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/product-form-validation.js"></script>
</body>
</html>