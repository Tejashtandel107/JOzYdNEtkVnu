<?php
    $counter = $first_item = intval($customers->firstItem());
    $last_item = intval($customers->lastItem());
    $total_records = $customers->total();
?>



<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/dataTables/datatables.min.css')); ?>

    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

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
                        <?php echo e(Form::model($request,array('url' =>route('admin.customers.index'),'method'=>'get','id'=>'form-filter'))); ?>

                        <div class="input-group-icon input-group-icon-left mr-3">
                            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                            <?php echo Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')); ?>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>    
                    <div class="flex-grow text-right">
                        <a class="btn btn-rounded btn-primary btn-air" href="<?php echo e(route('admin.customers.create')); ?>">Add Customer</a>
                    </div>                        
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>GSTIN</th>
                            <th style="min-width: 250px;"></th>
                            <th>Enable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php if(isset($customers) && $customers->count()>0): ?>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td>
                                <div><?php echo e($customer->fullname); ?></div>
                                <?php if(isset($customer->address) && !empty($customer->address)): ?>
                                    <small class="text-muted">
                                        <a href="https://maps.google.com/?q=<?php echo e($customer->address); ?>" target="_blank"><i class="fas fa-map-marker-alt"></i>&nbsp;<?php echo e($customer->address); ?>&nbsp;</a><br>
                                    </small>
                                <?php endif; ?>
                                <?php if(isset($customer->phone) && !empty($customer->phone)): ?>
                                <small class="text-muted">
                                    <a href="tel:<?php echo e($customer->phone); ?>"><i class="fa fa-phone"></i>&nbsp;<?php echo e($customer->phone); ?>&nbsp;</a>
                                </small>
                                <?php endif; ?>
                                <?php if(isset($customer->contact_person) && !empty($customer->contact_person)): ?>
                                <small class="text-muted"><i class="fa fa-user"></i>&nbsp;<?php echo e($customer->contact_person); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($customer->gstnumber); ?></td>
                            <td>
                                <?php echo e(Form::model($customer ,['method'=>'PATCH' , 'files'=>true, 'route' => ['admin.customers.update', $customer->customer_id],'id'=>"submit_form_".$customer->customer_id])); ?>

                                <div class="d-flex flex-wrap">
                                    <div class="mb-2 mr-3 w-170">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                            </div>
                                            <?php echo Form::text('last_invoice_date',null, array('class' => 'form-control datepicker', 'placeholder' => 'Last Invoice Date','required'=>true)); ?>                            
                                        </div>    
                                    </div>
                                    <div class="mb-2 mr-3 w-170">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <div class="input-group-text"><i class="fas fa-rupee-sign"></i></div>
                                            </div>
                                            <?php echo Form::text('invoice_limit',null, array('class' => 'form-control', 'placeholder' => 'Invoice Limit','required'=>true)); ?>                            
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <?php echo Form::button('Save', array('class' => 'btn btn-info','id'=>"submitbtn","onclick"=>"SubmitFunction($customer->customer_id,this);")); ?>

                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </td>
                            <td><?php if ($__env->exists('admin.inc.status', ['status' => $customer->isactive])) echo $__env->make('admin.inc.status', ['status' => $customer->isactive], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.customers.edit',$customer->customer_id)); ?>" title="Edit">
                                    <button class="btn btn-outline-info btn-sm mb-1"><i class="la la-pencil"></i> Edit </button>
                                </a> &nbsp;
                                <button class="btn btn-outline-danger btn-sm mb-1" onclick="deleteCustomer( '<?php echo e(route('admin.customers.destroy',$customer->customer_id)); ?>','<?php echo e($customer->customer_id); ?>' );" title="Delete">
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
                            <?php echo $customers->appends(['keyword'=>$request->keyword])->links(); ?>

                        <?php else: ?>
                            <?php echo $customers->links(); ?>

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

    <?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

    
    <?php echo Html::script('/assets/app/js/plugin/jquery.buttonSpinner.js'); ?>

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
	<?php echo Html::script('/assets/admin/js/customers/index.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/customers/index.blade.php ENDPATH**/ ?>