<?php
$application_name = config('app.name');
$auth_user = (Auth::check()) ? Auth::user() : null;
$user_role_lables = config('constant.USER_ROLE_LABELS');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="author" content="">
    <title><?php echo $__env->yieldContent('pagetitle'); ?> : <?php echo e($application_name); ?></title>
    <!-- GLOBAL MAINLY STYLES-->
<?php echo e(Html::style('/assets/app/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>

<?php echo e(Html::style('https://use.fontawesome.com/releases/v5.8.1/css/all.css',['integrity'=>'sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf','crossorigin'=>'anonymous'])); ?>

<?php echo e(Html::style('/assets/app/vendors/line-awesome/css/line-awesome.min.css')); ?>

<?php echo e(Html::style('/assets/app/vendors/themify-icons/css/themify-icons.css')); ?>

<?php echo e(Html::style('/assets/app/vendors/toastr/toastr.min.css')); ?>

<?php echo e(Html::style('https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css')); ?>

<!-- PLUGINS STYLES-->
<?php echo $__env->yieldContent('plugin-css'); ?>
<!-- THEME STYLES-->
<?php echo e(Html::style('/assets/admin/css/main.css')); ?>

<?php echo e(Html::style('/assets/admin/css/app.css')); ?>

<!-- PAGE LEVEL STYLES-->
    <?php echo $__env->yieldContent('page-css'); ?>
</head>
<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    <header class="header">
        <div class="page-brand">
            <a href="<?php echo e(route('admin.home')); ?>">
                <span class="brand"><?php echo e(config('constant.APP_NAME_SHORT')); ?></span>
                <span class="brand-mini"><?php echo e(config('constant.APP_NAME_SHORT')); ?></span>
            </a>
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->

            <!-- START TOP-RIGHT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li class="dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                        <span><?php echo e($auth_user->username); ?></span>
                        <img src="<?php echo e($auth_user->photo); ?>" alt="image" style="width:50px;height: 50px;" />
                    </a>
                    <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                        <div class="dropdown-arrow"></div>
                        <div class="dropdown-header">
                            <div class="admin-profile">
                                <img width="100%" height="100%" class="img-circle profile-img" src="<?php echo e($auth_user->photo); ?>" alt="image">
                            </div>
                            <div>
                                <h5 class="font-strong text-white"><?php echo e($auth_user->fullname); ?></h5>
                                <div>
                                    <span class="admin-badge mr-3"><?php echo e($user_role_lables[$auth_user->role_id]['display_name']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="admin-menu-features px-3">
                            <div class="d-flex justify-content-between w-100">
                                 <div class="">
                                    <a class="dropdown-item" href="<?php echo e(route('admin.profile.edit',$auth_user->user_id)); ?>"><i class="fa fa-user"></i>Profile</a>
                                 </div>   
                                 <div>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout<i
                                                class="ti-shift-right ml-2 font-20"></i></a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                 </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </header>
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
    <nav class="page-sidebar" id="sidebar">
        <div id="sidebar-collapse">
            <ul class="side-menu metismenu">
                <li>
                    <a <?php echo (isset($menuChild) && $menuChild=='dashboard') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.home')); ?>">
                        <i class="sidebar-item-icon fas fa-tachometer-alt"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li <?php echo (isset($menuParent) && $menuParent=='items') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-box-open"></i>
                        <span class="nav-label">Items</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='additem') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.items.create')); ?>">Add
                                New Item</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='items') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.items.index')); ?>">Items</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='item-markas') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.item-marka.index')); ?>">Markas</a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (isset($menuParent) && $menuParent=='customers') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-users"></i>
                        <span class="nav-label">Users</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">                        
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='customers') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.customers.index')); ?>">Customers</a>
                        </li>
                    <?php if($auth_user->role_id == config('constant.ROLE_SUPER_ADMIN_ID')): ?>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='admins') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.admins')); ?>">Admins</a>
                        </li>
                    <?php endif; ?>  
                    </ul>
                </li>
                <li <?php echo (isset($menuParent) && $menuParent=='inwards') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-truck-loading"></i>
                        <span class="nav-label">Inward</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">                        
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='inward') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.inwards.create')); ?>">Add New</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='allinward') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.inwards.index')); ?>">Inwards</a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (isset($menuParent) && $menuParent=='outwards') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-truck"></i>
                        <span class="nav-label">Outward</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">                        
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='outward') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.outwards.create')); ?>">Add New</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='alloutward') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.outwards.index')); ?>">Outwards</a>
                        </li>
                    </ul>
                </li>
            
                <li <?php echo (isset($menuParent) && $menuParent=='reports') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-chart-line"></i>
                        <span class="nav-label">Reports</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='full-ledger') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.reports.full-ledger.show')); ?>">Stocks Report</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='stock-report') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.reports.stock-report.show')); ?>">Storage Capacity</a>
                        </li>
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='insuarnce-report') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.reports.insurance-report.show')); ?>">Insurance</a>
                        </li>
                    </ul>
                </li>
                <?php if($auth_user->role_id == config('constant.ROLE_SUPER_ADMIN_ID')): ?>
                   <li <?php echo (isset($menuParent) && $menuParent=='trash') ? " class='active'" : ''; ?>>
                    <a href="#">
                        <i class="sidebar-item-icon fas fa-trash"></i>
                        <span class="nav-label">Trash</span><i class="fa fa-angle-left arrow"></i>
                    </a>
                    <ul class="nav-2-level collapse">
                        <li>
                            <a <?php echo (isset($menuChild) && $menuChild=='trashorders') ? "class='active'" : ''; ?> href="<?php echo e(route('admin.trash.orders')); ?>">Orders</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            </ul>
            <div class="sidebar-footer">
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-power-off"></i></a>
            </div>
        </div>
    </nav>
    <!-- END SIDEBAR-->
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->    <!-- START PAGE CONTENT-->
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/layouts/app/header.blade.php ENDPATH**/ ?>