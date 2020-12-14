<?php
require '../functions.inc.php';
$query = new Query;


$message = '';
$className = '';
$data = $query->getDataFrom('tbl_product','tbl_product_description',["id","prod_id"]);

if(isset($_REQUEST['product']) and $_REQUEST['product'] != ''){
	if($_REQUEST['product'] == 'delete') {
		$id = $query->getSafeValue($_REQUEST['id']);
		$result = $query->deleteData('tbl_product',["id"=>$id]);
		if($result){
			header('location: view-products.php?delete_status=1');
		} else {
			$message = '<strong>Product Deletion</strong> Failed!';
			$className = 'alert-danger';
		}
	}
}

if(isset($_REQUEST['update_status']) and $_REQUEST['update_status'] != ''){
	$message = '<strong>Product Updated</strong> Successfully!';
	$className = 'alert-success';
}
if(isset($_REQUEST['delete_status']) and $_REQUEST['delete_status'] != ''){
	$message = '<strong>Product Deleted</strong> Successfully!';
	$className = 'alert-success';
}

require 'header.inc.php';
?>


<main class="content">
	<div class="container-fluid p-0">
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
		<h1 class="h3">Products</h1>
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card p-2 pr-3">
					<div class="card-header">
						<h5 class="card-title">Product Details</h5>
					</div>
					<table id="myTable" class="m-2 table display table-responsive table-stripped">
					    <thead>
					        <tr>
					            <th>#</th>
					            <th>SKU</th>
					            <th>Category</th>
					            <th>Sub-Category</th>
					            <th>Product Name</th>
					            <th>Launch Date</th>
					            <th>Monthly Price</th>
					            <th>Annual Price</th>
					            <th>Web Space</th>
					            <th>Band Width</th>
					            <th>Free Domain</th>
					            <th>Mail Box</th>
					            <th>Language Supports</th>
					            <th>Available</th>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    		$sr = 1;
					    		if($data != 0) {
					    			foreach($data as $d) {
							            	$desc = (array)json_decode($d['description']);
					    				?>
					    				 <tr>
								            <td><?php echo $sr; ?></td>
								            <td><?php echo $d['sku']; ?></td>
								            <td>
								            	<?php 
								            	$category = $query->getData('tbl_product',['prod_name'],["prod_parent_id"=>0]);
								            	if($category != 0) {
								            		echo $category[0]['prod_name'];
								            	}
									            ?>
								            </td>
								            <td>
							            	<?php
								            	$pid = $d['prod_parent_id'];
								            	$subCategory = $query->getData('tbl_product',["prod_name"],["id"=>$pid]);
								            	if($subCategory != 0) {
								            		echo $subCategory[0]['prod_name'];
								            	}
							            	?>
								            </td>
								            <td><?php echo $d['prod_name']; ?></td>
								            <td><?php echo $d['prod_launch_date']; ?></td>
								            <td>Rs.<?php echo $d['mon_price']; ?>/-</td>
								            <td>Rs.<?php echo $d['annual_price']; ?>/-</td>
								            <td><?php echo $desc['web_space']; ?>GB</td>
								            <td><?php echo $desc['band_width']; ?>GB</td>
								            <td><?php echo $desc['free_domain']; ?></td>
								            <td><?php echo $desc['mail_box']; ?></td>
								            <td><?php echo $desc['technology']; ?></td>
								            <td>
								            	<?php 
								            		echo $d['prod_available']?'Yes':'No';
									            ?>
								            </td>
								            <td>
								            	<a href="add-product.php?product=edit&id=<?php echo $d['prod_id']; ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="align-middle" data-feather="edit-2"></i></a>
												<a href="?product=delete&id=<?php echo $d['prod_id']; ?>" data-toggle="tooltip" data-placement="right" title="Delete"><i class="align-middle" data-feather="trash"></i></a>
								            </td>
								        </tr>

					    				<?php
					    				$sr++;
					    			}
					    		}
					    	?>
					    	
					       
					    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</main>
<?php
require 'footer.inc.php';
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready( function () {
	    $('#myTable').DataTable();
	} );
</script>
</body>
</html>