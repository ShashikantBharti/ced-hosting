<?php
session_start();
if (isset($_SESSION['USER_ID'])) {
    if(isset($_SESSION['IS_ADMIN']) and $_SESSION['IS_ADMIN'] != 1) {
        header('location: ../');
    }
} else {
    header('location: ../');
}

$URL = basename($_SERVER['REQUEST_URI']);
$productURL = array('create-category.php','add-product.php','view-products.php','create-new-offer.php');
$ordersURL = array('pending-orders.php','completed-orders.php','cancelled-orders.php','generate-invoice.php');
$servicesURL = array('active-services.php','expired-services.php');
$usersURL = array('all-users.php','create-new-user.php');
$blogURL = array('add-new-blog.php','view-all-blogs.php');
$accountsURL = array('update-company-info.php','change-security-question.php','change-password.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
        <meta name="author" content="AdminKit">
        <meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">
        <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
        <title>Ced Hosting | Admin</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <nav id="sidebar" class="sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="index.php">
                        <span class="align-middle"><i class="align-middle" data-feather="activity"></i> Ced Hosting</span>
                    </a>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item <?php if ($URL == 'admin'||$URL=='index.php') {
                            echo 'active';
                                                } ?>">
                            <a class="sidebar-link" href="index.php">
                                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>

                        <!-- Products Nav -->
                        <li class="sidebar-item <?php echo in_array($URL, $productURL)?'active':''; ?>">
                            <a href="#products" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Products</span>
                            </a>
                            <ul id="products" class="sidebar-dropdown list-unstyled collapse<?php echo in_array($URL, $productURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'create-category.php') {
                                    echo 'active';
                                                        } ?>"><a class="sidebar-link" href="create-category.php">Create Category</a></li>
                                <li class="sidebar-item <?php if ($URL == 'add-product.php') {
                                    echo 'active';
                                                        } ?>"><a class="sidebar-link" href="add-product.php">Add Product</a></li>
                                <li class="sidebar-item <?php if ($URL == 'view-products.php') {
                                    echo 'active';
                                                        } ?> "><a class="sidebar-link" href="view-products.php">View Product</a></li>
                                <li class="sidebar-item <?php if ($URL == 'create-new-offer.php') {
                                    echo 'active';
                                                        } ?>"><a class="sidebar-link" href="create-new-offer.php">Create New Offer</a></li>
                            </ul>
                        </li>
                        <!-- //Products Nav -->
                        
                        <!-- Order Nav -->
                        <li class="sidebar-item <?php echo in_array($URL, $ordersURL)?'active':''; ?>">
                            <a href="#orders" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Orders</span>
                            </a>
                            <ul id="orders" class="sidebar-dropdown list-unstyled collapse <?php echo in_array($URL, $ordersURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'pending-orders.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="pending-orders.php">Pending Orders</a></li>
                                <li class="sidebar-item <?php if ($URL == 'completed-orders.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="completed-orders.php">Completed Orders</a></li>
                                <li class="sidebar-item <?php if ($URL == 'cancelled-orders.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="cancelled-orders.php">Cancelled Orders</a></li>
                                <li class="sidebar-item <?php if ($URL == 'generate-invoice.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="generate-invoice.php">Generate Invoice</a></li>
                            </ul>
                        </li>
                        <!-- //Orders Nav -->

                        <!-- Services -->
                        <li class="sidebar-item <?php echo in_array($URL, $servicesURL)?'active':''; ?>">
                            <a href="#services" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="package"></i> <span class="align-middle">Services</span>
                            </a>
                            <ul id="services" class="sidebar-dropdown list-unstyled collapse <?php echo in_array($URL, $servicesURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'active-services.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="active-services.php">Active Services</a></li>
                                <li class="sidebar-item <?php if ($URL == 'expired-services.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="expired-services.php">Expired Services</a></li>
                            </ul>
                        </li>
                        <!-- //Services -->
                        <!-- Users -->
                         <li class="sidebar-item  <?php echo in_array($URL, $usersURL)?'active':''; ?>">
                            <a href="#users" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                            </a>
                            <ul id="users" class="sidebar-dropdown list-unstyled collapse <?php echo in_array($URL, $usersURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'all-users.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="all-users.php">All User</a></li>
                                <li class="sidebar-item <?php if ($URL == 'create-new-user.php') {
                                    echo 'active';} ?>"><a class="sidebar-link" href="create-new-user.php">Create New User</a></li>
                            </ul>
                        </li>
                        <!-- //Users -->
                        <!-- Blog -->
                        <li class="sidebar-item <?php echo in_array($URL, $blogURL)?'active':''; ?>">
                            <a href="#blog" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Blog</span>
                            </a>
                            <ul id="blog" class="sidebar-dropdown list-unstyled collapse <?php echo in_array($URL, $blogURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'add-new-blog.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="add-new-blog.php">Add New Blog</a></li>
                                <li class="sidebar-item <?php if ($URL == 'view-all-blogs.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="view-all-blogs.php">View All Blogs</a></li>
                            </ul>
                        </li>
                        <!-- //Blog -->
                        <!-- Accounts -->
                        <li class="sidebar-item <?php echo in_array($URL, $accountsURL)?'active':''; ?>">
                            <a href="#accounts" data-toggle="collapse" class="sidebar-link collapsed">
                                <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Accounts</span>
                            </a>
                            <ul id="accounts" class="sidebar-dropdown list-unstyled collapse <?php echo in_array($URL, $accountsURL)?'show':''; ?>" data-parent="#sidebar">
                                <li class="sidebar-item <?php if ($URL == 'update-company-info.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="update-company-info.php">Update Company Info</a></li>
                                <li class="sidebar-item <?php if ($URL == 'change-security-question.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="change-security-question.php">Change Security Ques</a></li>
                                 <li class="sidebar-item <?php if ($URL == 'change-password.php') {
                                    echo 'active'; } ?>"><a class="sidebar-link" href="change-password.php">Change Password</a></li>
                            </ul>
                        </li>
                        <!-- //Accounts -->
                        <!-- Logout -->
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="logout.php">
                                <i class="align-middle" data-feather="power"></i><span class="align-middle">Logout</span>
                            </a>
                        </li>
                        <!-- //Logout -->
                    </ul>
                </div>
            </nav>
            <div class="main">
                <nav class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle d-flex">
                        <i class="hamburger align-self-center"></i>
                    </a>
                    <form class="form-inline d-none d-sm-inline-block">
                        <div class="input-group input-group-navbar">
                            <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn" type="button">
                                <i class="align-middle" data-feather="search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                                    <div class="position-relative">
                                        <i class="align-middle" data-feather="bell"></i>
                                        <span class="indicator">4</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                                    <div class="dropdown-menu-header">
                                        4 New Notifications
                                    </div>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <i class="text-danger" data-feather="alert-circle"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Update completed</div>
                                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                    <div class="text-muted small mt-1">30m ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <i class="text-warning" data-feather="bell"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Lorem ipsum</div>
                                                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                    <div class="text-muted small mt-1">2h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <i class="text-primary" data-feather="home"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">Login from 192.186.1.8</div>
                                                    <div class="text-muted small mt-1">5h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <i class="text-success" data-feather="user-plus"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark">New connection</div>
                                                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                    <div class="text-muted small mt-1">14h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu-footer">
                                        <a href="#" class="text-muted">Show all notifications</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
                                    <div class="position-relative">
                                        <i class="align-middle" data-feather="message-square"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">
                                    <div class="dropdown-menu-header">
                                        <div class="position-relative">
                                            4 New Messages
                                        </div>
                                    </div>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                                </div>
                                                <div class="col-10 pl-2">
                                                    <div class="text-dark">Vanessa Tucker</div>
                                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                                    <div class="text-muted small mt-1">15m ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                                                </div>
                                                <div class="col-10 pl-2">
                                                    <div class="text-dark">William Harris</div>
                                                    <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                                    <div class="text-muted small mt-1">2h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                                </div>
                                                <div class="col-10 pl-2">
                                                    <div class="text-dark">Christina Mason</div>
                                                    <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                                    <div class="text-muted small mt-1">4h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-2">
                                                    <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                                </div>
                                                <div class="col-10 pl-2">
                                                    <div class="text-dark">Sharon Lessman</div>
                                                    <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                                    <div class="text-muted small mt-1">5h ago</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu-footer">
                                        <a href="#" class="text-muted">Show all messages</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>
                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                    <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="Charles Hall" /> <span class="text-dark">Admin</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="pages-profile.php"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="pie-chart"></i> Analytics</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pages-settings.php"><i class="align-middle mr-1" data-feather="settings"></i> Settings & Privacy</a>
                                    <a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="help-circle"></i> Help Center</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Log out</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>