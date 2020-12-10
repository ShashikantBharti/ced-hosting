<?php

require '../functions.inc.php';

ob_start();
$query = new Query;


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
						<!-- <h6 class="card-subtitle text-muted">Single horizontal row.</h6> -->
					</div>
					<div class="card-body">
						<form class="form-inline">
							<select class="custom-select mb-2 mr-2" name="mainCategory">
								<option selected>Main Category...</option>
								<?php 
									$result = $query->getData('tbl_product','',['prod_parent_id'=>0]);
									?>
									<option value="0"><?php echo $result[0]['prod_name']; ?></option>
									<?php
								?>
								
							</select>
							<input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="Category Name..." name="name" required>
							<input type="text" class="form-control mb-2 mr-sm-2" id="link" placeholder="Link..." name="link">
							<select class="custom-select mb-2 mr-2" name="isAvailable">
								<option selected>Is Available...</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
							<button type="submit" name="category" value="add" class="btn btn-primary mb-2">Submit</button>
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
						<!-- <h6 class="card-subtitle text-muted">Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</h6> -->
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Parent Name</th>
								<th>Product Name</th>
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
									<a href="#" data-toggle="tooltip" data-placement="left" title="Edit"><i class="align-middle" data-feather="edit-2"></i></a>
									<a href="#" data-toggle="tooltip" data-placement="right" title="Delete"><i class="align-middle" data-feather="trash"></i></a>
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

</body>
</html>