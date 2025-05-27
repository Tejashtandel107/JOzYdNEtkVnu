<?php $__env->startSection('pagetitle',$pagetitle); ?>
<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

    <?php echo e(Html::style('/assets/app/vendors/formvalidation/formValidation.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
    <!-- Page Heading Breadcrumbs -->
	<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content fade-in-up">
        <div class="ibox ibox-fullheight">
            <?php if(isset($marka)): ?>
                <?php echo Form::model($marka, ['method' => 'PATCH', 'route' => ['admin.item-marka.update', $marka->marka_id], 'id' => 'marka-form']); ?>

            <?php else: ?>
                <?php echo Form::open(array('route' => 'admin.item-marka.store', 'id' => 'marka-form')); ?>

            <?php endif; ?>
                <div class="ibox-body">
					<div id="notify"></div>
					<div class="form-group">
                        <?php echo Form::label('item_id', 'Item'); ?>

						<?php echo Form::select('item_id', (array(""=>"Select Item") + $items), null , ['class' => 'form-control', 'id'=>'item_id']); ?>

						<?php if($errors->has('item_id')): ?>
			                <small class="error"><?php echo e($errors->first('item_id')); ?></small>
			            <?php endif; ?>
                    </div>
                    <div class="form-group mb-4<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <?php echo Form::label('name', 'Name'); ?>

                        <?php echo Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Marka name')); ?>

    					<?php if($errors->has('name')): ?>
    		                <small class="error"><?php echo e($errors->first('name')); ?></small>
    		            <?php endif; ?>
                    </div>					
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-info mr-2" type="submit" id="submitbtn">Submit</button>
					<a href="<?php echo e(route('admin.item-marka.index')); ?>" class="btn btn-secondary">Cancel</a>
                </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('plugin-scripts'); ?>
	<?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/formvalidation/formValidation.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <!-- <?php echo Html::script('/assets/admin/js/item-marka/create.js'); ?>	 -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/item-marka/create.blade.php ENDPATH**/ ?>