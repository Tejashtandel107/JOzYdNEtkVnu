<?php
    $counter=$first_item=intval($markas->firstItem());
    $last_item=intval($markas->lastItem());
    $total_records=$markas->total();
?>

<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
    <!-- Page Heading Breadcrumbs -->
    <?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div id="notify"></div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="mb-3"><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                <?php echo e(Form::model($request,array('url' =>route('admin.item-marka.index'),'method'=>'get','id'=>'form-filter'))); ?>

                    <div class="d-flex flex-wrap">                    
                        <div class="flex-nowrap flex-grow form-inline mr-3 mb-2">
                            <label class="mb-2 mr-2">Item:</label>
                            <?php echo Form::select('item_id', (array(""=>"Select Item") + $items->pluck('name','item_id')->toArray()), null , ['class' => 'form-control','onchange'=>'formsubmit()']); ?>

                        </div>
                        <div class="flex-grow mb-2">                            
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <?php echo Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')); ?>

                            </div>                            
                        </div>                       
                        <div class="flex-grow text-right">
                            <a class="btn btn-rounded btn-primary btn-air" href="<?php echo e(route('admin.item-marka.create')); ?>">Add Marka</a>
                        </div>    
                    </div>
                <?php echo e(Form::close()); ?>                     
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="customers-table">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>#</th>
                                <th>Marka Name</th>
                                <th>Item Name</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php if(isset($markas) && $markas->count()>0): ?>
                        <?php $__currentLoopData = $markas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($counter++); ?></td>                                
                                <td><?php echo e($marka->name); ?></td>
                                <td><?php echo e($marka->item_name); ?></td>
                                <td><?php echo e($marka->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.item-marka.edit',$marka->marka_id)); ?>" class="btn btn-sm btn-outline-info mb-1">
                                        <span class="btn-icon"><i class="la la-pencil"></i>Edit</span>
                                    </a>&nbsp;&nbsp;
                                    <button class="btn btn-sm btn-outline-danger mb-1" onclick="deleteMarka('<?php echo e(route('admin.item-marka.destroy',$marka->marka_id)); ?>');">
                                        <span class="btn-icon"><i class="la la-trash"></i>Delete</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                            <tr>
                                <td colspan="6"><div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div></td>
                            <tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="flexbox mb-4 mt-4 noprint">
                        <div class="form-inline noprint">                        
                            <div><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                        </div>
                        <div class="flexbox noprint">
                            <?php if($request->all()): ?>
                                <?php echo $markas->appends($request->all())->links(); ?>

                            <?php else: ?>
                                <?php echo $markas->links(); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('plugin-scripts'); ?>
    <?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
	<?php echo Html::script('/assets/admin/js/item-marka/index.js'); ?>

    <?php if(session('type')): ?>
    	<script type="text/javascript">
    		<?php if(session('type')=="success"): ?>
    			$("#notify").notification({caption: "<?php echo e(session('message')); ?>", sticky:false, type:'<?php echo e(session('type')); ?>'});
    		<?php else: ?>
    			$("#notify").notification({caption: "<?php echo e(session('message')); ?>", sticky:true, type:'<?php echo e(session('type')); ?>'});
    		<?php endif; ?>
    	</script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/item-marka/index.blade.php ENDPATH**/ ?>