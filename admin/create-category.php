<?php

require '../functions.inc.php';

ob_start();
$query = new Query;

$message = '';
$className = '';
$name = '';
$link = '';
$isAvailable = '';

$action = 'add';

if(isset($_REQUEST['category']) and $_REQUEST['category'] != '') {
	switch($_REQUEST['category']) {
		case 'add':
			$mainCategory = $query->getSafeValue($_REQUEST['mainCategory']);
			$name = ucwords($query->getSafeValue($_REQUEST['name']));
			$link = $query->getSafeValue($_REQUEST['link']);
			$isAvailable = $query->getSafeValue($_REQUEST['isAvailable']);

			$result = $query->getData('tbl_product','',["prod_name"=>$name]);

			if($result != 0) {
				$message = '<strong>Category</strong> Already Exists!';
				$className = 'alert-danger';
			} else {
				$result = $query->insertData('tbl_product',["prod_parent_id"=>$mainCategory,"prod_name"=>$name,"link"=>$link,"prod_available"=>$isAvailable]);
				if($result != 0){
					$message = '<strong>New Category</strong> Added Successfully!';
					$className = 'alert-success';
				} else {
					$message = '<strong>New Category</strong> Adition Failed!';
					$className = 'alert-danger';
				}
			}
			$name = '';
			$link = '';
		break;
		case 'edit';
			$id = $query->getSafeValue($_REQUEST['id']);
			$result = $query->getData('tbl_product','',["id"=>$id]);
			if($result != 0) {
				$name = $result[0]['prod_name'];
				$link = $result[0]['link'];
				$isAvailable = (int)$result[0]['prod_available'];
				$action = 'update';
			} else {
				$message = '<strong>Category</strong> Not Found!';
				$className = 'alert-danger';
			}

		break;
		case 'update':
			$mainCategory = $query->getSafeValue($_REQUEST['mainCategory']);
			$name = ucwords($query->getSafeValue($_REQUEST['name']));
			$link = $query->getSafeValue($_REQUEST['link']);
			$isAvailable = $query->getSafeValue($_REQUEST['isAvailable']);
			$id = $query->getSafeValue($_REQUEST['id']);

			$data = $query->getData('tbl_product','',["id"=>$id]);
			if(ucwords($data[0]['prod_name']) == $name && $data[0]['link'] == $link && $data[0]['prod_available'] == $isAvailable) {
				$message = '<strong>Nothing</strong> is Updated!';
				$className = 'alert-warning';
			} else {
				$result = $query->updateData('tbl_product',["prod_parent_id"=>$mainCategory,"prod_name"=>$name,"link"=>$link,"prod_available"=>$isAvailable],["id"=>$id]);

				if($result) {
					$message = '<strong>Category</strong> Updated Successfully!';
					$className = 'alert-success';
				} else {
					$message = '<strong>Category</strong> Updation Failed!';
					$className = 'alert-danger';	
				}
			}
			$name = '';
			$link = '';
		break;
		case 'delete':
			$id = $query->getSafeValue($_REQUEST['id']);
			$result = $query->deleteData('tbl_product',["id"=>$id]);
			if($result) {
				$message = '<strong>Category</strong> Deleted Successfully!';
				$className = 'alert-success';
			} else {
				$message = '<strong>Category</strong> Deletion Failed!';
				$className = 'alert-danger';	
			}
			$name = '';
			$link = '';
		break;
	}
}

ob_end_flush();
require 'header.inc.php';
?><main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Category</h1>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header mb-n4">
						<h5 class="card-title">Create New Category</h5>
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
					<div class="card-body">
						<form class="form-inline" method="POST" id="cat-form">
							<select class="custom-select mb-2 mr-2" name="mainCategory" id="category" required>
								<option value="">Main Category...</option>
								<?php 
									$result = $query->getData('tbl_product','',['prod_parent_id'=>0]);
									?>
									<option <?php echo ($action == 'update')?'selected':''; ?> value="1"><?php echo $result[0]['prod_name']; ?></option>
									<?php
								?>
								
							</select>
							<input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="Category Name..." name="name" value="<?php echo $name; ?>" required pattern="^([a-z0-9]+(\.[a-z0-9]+)?)$">
							<input type="text" class="form-control mb-2 mr-sm-2" id="link" placeholder="Link..." value="<?php echo $link; ?>" name="link">
							<select class="custom-select mb-2 mr-2" name="isAvailable" id="isAvailable" required>
								<option value="">Is Available...</option>
								<option <?php echo ($isAvailable === 1)?'selected':''; ?> value="1">Yes</option>
								<option <?php echo ($isAvailable === 0)?'selected':''; ?> value="0">No</option>
							</select>
							<input type="hidden" name="id" value="<?php echo isset($id)?$id:''; ?>">
							<button type="submit" name="category" value="<?php echo $action; ?>" class="btn btn-primary mb-2"><?php echo ucfirst($action); ?></button>
						</form>
					</div>
				</div>
			</div>
			<!-- //Form -->
			<!-- Show Category in Table -->
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header mb-n4">
						<h5 class="card-title">All Categories</h5>
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Sub-Category</th>
								<th>Link</th>
								<th>Availibility</th>
								<th class="d-none d-md-table-cell" style="width:25%">Launch Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result = $query->getData('tbl_product','',["prod_parent_id"=>1]);
								if($result != 0) {
									$sr = 1;
									foreach($result as $category) {
										?>

							<tr>
								<td><?php echo $sr++; ?></td>
								<td><?php 
								echo $query->getData('tbl_product','',["prod_parent_id"=>0])[0]['prod_name'];

								 ?></td>
								<td><?php echo $category['prod_name']; ?></td>
								<td> <?php echo $category['link']; ?> </td>
								<td><?php echo $category['prod_available']?'Yes':'No'; ?></td>
								<td class="d-none d-md-table-cell"><?php echo $category['prod_launch_date']; ?></td>
								<td class="table-action">
									<a href="?category=edit&id=<?php echo $category['id']; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="align-middle" data-feather="edit-2"></i></a>
									<a href="?category=delete&id=<?php echo $category['id']; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="align-middle" data-feather="trash"></i></a>
								</td>
							</tr>
								<?php
									}
								} else {
									echo '<h6 class="card-subtitle text-muted ml-4 mt-2">No Record Found!</h6>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- //Show Category in Table -->
		</div>
	</div>
	</main>


<?php
require 'footer.inc.php';
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- <script src="js/category-form-validation.js"></script> -->
</body>
</html>