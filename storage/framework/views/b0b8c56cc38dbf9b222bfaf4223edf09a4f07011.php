<?php
    $counter=$first_item=intval($items->firstItem());
    $last_item=intval($items->lastItem());
    $total_records=$items->total();
?>

<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('pagecontent'); ?>
    <!-- Page Heading Breadcrumbs -->
    <?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div id="notify"></div>
                <?php echo e(Form::model($request,array('url' =>route('admin.items.index'),'method'=>'get','id'=>'form-filter'))); ?>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="mb-3"><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>                            
                    <div class="d-flex flex-wrap">
                        <div class="form-inline flex-grow mb-2">
                            <label class="mb-0 mr-2">Show:</label>
                            <?php echo Form::select('show', (array("25"=>"25","50"=>"50","100"=>"100")), $show , ['class' => 'form-control mr-2 mb-2', 'onchange'=>'formsubmit()']); ?>                            
                        </div>
                        <div class="flex-grow mb-2">
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <?php echo Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')); ?>

                            </div>                        
                        </div>    
                        <div class="flex-grow text-right">
                            <a class="btn btn-rounded btn-primary btn-air" href="<?php echo e(route('admin.items.create')); ?>">Add Item</a>                        
                        </div>    
                    </div>                
                </div>
                <?php echo e(Form::close()); ?>

                <div class="table-responsive">
                    <table class="table table-hover" id="customers-table">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Enable</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php if(isset($items) && $items->count()>0): ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($counter++); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->description); ?></td>
                                <td><?php echo e($item->created_at); ?></td>
                                <td><?php if ($__env->exists('admin.inc.status', ['status' => $item->isactive])) echo $__env->make('admin.inc.status', ['status' => $item->isactive], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.items.edit',$item->item_id)); ?>" class="btn btn-sm btn-outline-info mb-1">
                                        <span class="btn-icon"><i class="la la-pencil"></i>Edit</span>
                                    </a>&nbsp;&nbsp;
                                    <button class="btn btn-sm btn-outline-danger mb-1" onclick="deleteItem('<?php echo e(route('admin.items.destroy',$item->item_id)); ?>');">
                                        <span class="btn-icon"><i class="la la-trash"></i>Delete</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                            <tr>
                                <td colspan="12"><div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div></td>
                            <tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="flexbox mb-4 mt-4 noprint">
                        <div class="form-inline noprint">                        
                            <div><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                        </div>
                        <div class="flexbox noprint">
                            <?php if($request->filled('keyword')): ?>
                                <?php echo $items->appends(['keyword'=>$request->keyword])->links(); ?>

                            <?php else: ?>
                                <?php echo $items->links(); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
	<?php echo Html::script('/assets/admin/js/items/index.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/items/index.blade.php ENDPATH**/ ?>