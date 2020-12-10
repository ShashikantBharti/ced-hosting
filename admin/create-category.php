<?php
require '../functions.inc.php';
$query = new Query;



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
								<option>Hosting</option>
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
							<tr>
								<td>1</td>
								<td>Hosting</td>
								<td>Linux Hosting</td>
								<td> </td>
								<td>Yes</td>
								<td class="d-none d-md-table-cell">June 21, 1961</td>
								<td class="table-action">
									<a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
									<a href="#"><i class="align-middle" data-feather="trash"></i></a>
								</td>
							</tr>
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