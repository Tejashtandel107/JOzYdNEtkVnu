<?php
    $counter = $first_item = intval($users->firstItem());
    $last_item = intval($users->lastItem());
    $total_records = $users->total();
?>



<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('pagecontent'); ?>
<!-- Page Heading Breadcrumbs -->
<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <div id="notify"></div>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div class="mb-3"><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                <div class="d-flex flex-wrap">
                    <div class="flex-grow mb-2">
                        <?php echo e(Form::model($request,array('url' =>route('admin.admins'),'method'=>'get','id'=>'form-filter'))); ?>

                        <div class="input-group-icon input-group-icon-left mr-3">
                            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                            <?php echo Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>    
                    <div class="flex-grow text-right">
                        <a class="btn btn-rounded btn-primary btn-air" href="<?php echo e(route('admin.admins.create')); ?>">Add Admin</a>
                    </div>                        
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Phone</th>
                            <th>Enable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php if(isset($users) && $users->count()>0): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td><img src="<?php echo e($user->photo); ?>" class="img-circle" alt="customer" height="40" width="40"> &nbsp;  <?php echo e($user->fullname); ?></td>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php if ($__env->exists('admin.inc.status', ['status' => $user->isactive])) echo $__env->make('admin.inc.status', ['status' => $user->isactive], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.admins.edit',$user->user_id)); ?>" title="Edit">
                                    <button class="btn btn-outline-info btn-sm mb-1"><i class="la la-pencil"></i> Edit </button>
                                </a> &nbsp;
                                <button class="btn btn-outline-danger btn-sm mb-1" onclick="deleteUser( '<?php echo e(route('admin.admins.destroy',$user->user_id)); ?>','<?php echo e($user->user_id); ?>' );" title="Delete">
                                    <i class="la la-trash"></i> Delete 
                                </button> &nbsp;
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                        <tr>
                            <td colspan="12"><div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div></td>
                        </tr>
                <?php endif; ?>
                    </tbody>
                </table>
                <div class="flexbox mb-4 mt-4 noprint">
                    <div class="form-inline noprint">                        
                        <div><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                    </div>
                    <div class="flexbox noprint">
                        <?php if($request->filled('keyword')): ?>
                            <?php echo $users->appends(['keyword'=>$request->keyword])->links(); ?>

                        <?php else: ?>
                            <?php echo $users->links(); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('plugin-scripts'); ?>
	<?php echo Html::script('/assets/app/vendors/dataTables/datatables.min.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
	<?php echo Html::script('/assets/admin/js/user/index.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/user/index.blade.php ENDPATH**/ ?>