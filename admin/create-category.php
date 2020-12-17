<?php

/**
 * Create category page.
 * 
 * PHP version 7
 * 
 * @category  Admin
 * @package   Ced_Hosting
 * @author    Shashikant Bharti <surya.indian321@gmail.com>
 * @copyright 2020 CEDCOSS 
 * @license   CEDCOSS 
 * @version   GIT: <7.2>
 * @link      http://127.0.0.1/training/ced_hosting
 */

require '../functions.inc.php';

ob_start();
$query = new Query;

$message = '';
$className = '';
$name = '';
$html = '';
$isAvailable = '';

$action = 'add';

if (isset($_REQUEST['category']) and $_REQUEST['category'] != '') {
    switch($_REQUEST['category']) {
    case 'add':
        $mainCategory = $query->getSafeValue($_REQUEST['mainCategory']);
        $name = ucwords($query->getSafeValue($_REQUEST['name']));
        $html = $query->getSafeValue($_REQUEST['html']);
        $isAvailable = $query->getSafeValue($_REQUEST['isAvailable']);

        $result = $query->getData('tbl_product', '', ["prod_name"=>$name]);

        if ($result != 0) {
            $message = '<strong>Category</strong> Already Exists!';
            $className = 'alert-danger';
        } else {
            $result = $query->insertData(
                'tbl_product', ["prod_parent_id"=>$mainCategory, 
                "prod_name"=>$name, "html"=>$html, "prod_available"=>$isAvailable]
            );
            if ($result != 0) {
                $message = '<strong>New Category</strong> Added Successfully!';
                $className = 'alert-success';
            } else {
                $message = '<strong>New Category</strong> Adition Failed!';
                $className = 'alert-danger';
            }
        }
        $name = '';
        $html = '';
        break;
    case 'edit';
        $id = $query->getSafeValue($_REQUEST['id']);
        $result = $query->getData('tbl_product', '', ["id"=>$id]);
        if ($result != 0) {
            $name = $result[0]['prod_name'];
            $html = $result[0]['html'];
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
        $html = $query->getSafeValue($_REQUEST['html']);
        $isAvailable = $query->getSafeValue($_REQUEST['isAvailable']);
        $id = $query->getSafeValue($_REQUEST['id']);

        $data = $query->getData('tbl_product', '', ["id"=>$id]);
        if (ucwords($data[0]['prod_name']) == $name 
            and $data[0]['html'] == $html
            and $data[0]['prod_available'] == $isAvailable
        ) {
            $message = '<strong>Nothing</strong> is Updated!';
            $className = 'alert-warning';
        } else {
            $result = $query->updateData(
                'tbl_product', ["prod_parent_id"=>$mainCategory, "prod_name"=>$name, 
                "link"=>$link, "prod_available"=>$isAvailable], ["id"=>$id]
            );

            if ($result) {
                $message = '<strong>Category</strong> Updated Successfully!';
                $className = 'alert-success';
            } else {
                $message = '<strong>Category</strong> Updation Failed!';
                $className = 'alert-danger';
            }
        }
        $name = '';
        $html = '';
        break;
    case 'delete':
        $id = $query->getSafeValue($_REQUEST['id']);
        $result = $query->deleteData('tbl_product', ["id"=>$id]);
        if ($result) {
            $message = '<strong>Category</strong> Deleted Successfully!';
            $className = 'alert-success';
        } else {
            $message = '<strong>Category</strong> Deletion Failed!';
            $className = 'alert-danger';
        }
        $name = '';
        $html = '';
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
                    <?php if($message != '') : ?>
                        <div class="alert <?php echo $className; ?> 
                            alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" 
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="alert-message">
                                <?php echo $message; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="cat-form">
                            <select class="custom-select mb-2 mr-2" 
                                name="mainCategory" id="category" required>
                                <option value="">Main Category...</option>
                                <?php 
                                    $result = $query->getData(
                                        'tbl_product', '', ['prod_parent_id'=>0]
                                    );
                                    ?>
                                <option 
                                <?php echo ($action == 'update')?'selected':''; ?> 
                                value="1"><?php echo $result[0]['prod_name']; ?>
                                </option>
                            </select>

                            <input type="text" class="form-control mb-2 mr-sm-2" 
                            id="name" placeholder="Category Name..." name="name" 
                            value="<?php echo $name; ?>" required 
                            pattern="^[a-zA-Z0-9 ]+$">

                            <textarea type="text" class="form-control mb-2 mr-sm-2" 
                            id="editor" 
                            name="html"> <?php echo $html; ?> </textarea>
                            
                            <select class="custom-select mb-2 mr-2 mt-3" 
                                name="isAvailable" id="isAvailable" required>
                                <option value="">Is Available...</option>
                                <option 
                                <?php echo ($isAvailable === 1)?'selected':''; ?> 
                                value="1">Yes</option>
                                <option 
                                <?php echo ($isAvailable === 0)?'selected':''; ?> 
                                value="0">No</option>
                            </select>

                            <input type="hidden" name="id" 
                            value="<?php echo isset($id)?$id:''; ?>">

                            <button type="submit" name="category" 
                            value="<?php echo $action; ?>" 
                            class="btn btn-primary mb-2">
                            <?php echo ucfirst($action); ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- //Form -->
            <!-- Show Category in Table -->
            <div class="col-12 col-xl-12">
                <div class="card table-responsive">
                    <div class="card-header mb-n4">
                        <h5 class="card-title">All Categories</h5>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>HTML</th>
                                <th>Availibility</th>
                                <th class="d-none d-md-table-cell" 
                                style="width:25%">Launch Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = $query->getData(
                            'tbl_product',  '', ["prod_parent_id"=>1]
                        );
                        if ($result != 0) {
                            $sr = 1;
                            foreach ($result as $category) {
                                ?>

                            <tr>
                            <td><?php echo $sr++; ?></td>
                            <td>
                                <?php 
                                $prodName = $query->getData(
                                    'tbl_product', '', ["prod_parent_id"=>0]
                                );
                                 echo $prodName[0]['prod_name'];
                                ?>
                            </td>
                            <td><?php echo $category['prod_name']; ?></td>
                            <td><?php echo $category['html']; ?> </td>
                            <td>
                                <?php echo $category['prod_available']?'Yes':'No'; ?>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <?php echo $category['prod_launch_date']; ?>
                            </td>
                            <td class="table-action">
                                    <?php $catid = $category['id']; ?>
                                    <a href="?category=edit&id=<?php echo $catid; ?>"
                                    data-toggle="tooltip" data-placement="left" 
                                    title="Edit"><i class="align-middle" 
                                    data-feather="edit-2"></i></a>
                                    <a 
                                    href="?category=delete&id=<?php echo $catid; ?>"
                                    data-toggle="tooltip" data-placement="right" 
                                    title="Delete"><i class="align-middle" 
                                    data-feather="trash"></i></a>
                                </td>
                            </tr>
                                <?php
                            }
                        } else {
                            echo '<h6 class="card-subtitle text-muted ml-4 mt-2">
								No Record Found!
								</h6>';
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" 
crossorigin="anonymous"></script>
 <script src="https://cdn.tiny.cloud/1/l2es4shp5mm2koffdmqa80qeu5yx27n2ah8ciwtk0pngs2o6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: 'textarea#editor',
        menubar: true
      });
    </script>
<!-- <script src="js/category-form-validation.js"></script> -->
</body>
</html>