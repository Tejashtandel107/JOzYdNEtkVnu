<?php
    $counter = $first_item = intval($customer_orders->firstItem());
    $last_item = intval($customer_orders->lastItem());
    $total_records = $customer_orders->total();
?>



<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/dataTables/datatables.min.css')); ?>

    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('pagecontent'); ?>
<!-- Page Heading Breadcrumbs -->
<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div class="ibox mb-2">
        <div class="ibox-body py-3">
            <?php echo e(Form::model($request, array('url' =>route('admin.inwards.index'),'method'=>'get','id'=>'form-filter','autocomplete'=>'off'))); ?>

            <div id="notify"></div>
            <div class="flexbox mb-2">
                <div class="col-lg-12 p-0">
                    <div class="d-flex flex-wrap pull-right">
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Date Range:</label>
                            <div class="input-group date">
                                <?php echo Form::text('from',null, array('class' => 'form-control datepicker','placeholder' => 'From')); ?>

                                <span class="input-group-addon pl-2 pr-2">to</span>
                                <?php echo Form::text('to',null, array('class' => 'form-control datepicker','placeholder' => 'To')); ?>

                            </div>
                        </div>
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Customer:</label>
                            <?php echo Form::select('customer_id', (array(""=>"Select") + $customers->pluck('fullname','customer_id')->toArray()), null , ['class' => 'form-control','onchange'=>'formsubmit()']); ?>

                        </div>
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Filter Records:</label>
                            <?php echo Form::select('f', (array(""=>"Show All","ac"=>"Only Additional Charge")), null , ['class' => 'form-control','onchange'=>'formsubmit()']); ?>

                        </div>
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Search:</label>
                            <div class="input-group-icon input-group-icon-left">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <?php echo Form::text('s',null, array('class' => 'form-control','placeholder' => 'Search Serial Number')); ?>

                            </div>
                        </div>    
                        <div class="mb-2 align-self-end">
                            <button class="btn btn-primary" href="javascript:void(0)" onclick="formsubmit()">Filter</button>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>   
    </div>   
    <div class="ibox">
        <div class="ibox-body">
            <div class="flexbox mb-2">
                <div class="form-inline">
                    <label class="mb-0 mr-2">Show:</label>
                    <?php echo Form::select('p', (array("50"=>"50","100"=>"100","150"=>"150","200"=>"200","300"=>"300")), $show , ['class' => 'form-control mr-2', 'onchange'=>'formsubmit()']); ?>

                    <div><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                </div>
            <?php echo e(Form::close()); ?>                
                <div class="pull-right">                                                                        
                    <a class="btn btn-primary btn-rounded btn-air mb-2" href="<?php echo e(route('admin.inwards.create')); ?>">Add Inward</a> &nbsp;&nbsp;
                    <a class="btn btn-dark btn-rounded btn-air mb-2" onclick="printList('<?php echo e(route('admin.inwards.print',$request->all())); ?>')" href="javascript:void(0)"><i class="fa fa-print"></i> Print </a>                                                
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Serial No.</th>
                            <th>Inward Date</th>
                            <th>Customer</th>
                            <th>From</th>
                            <th>Vehicle Number</th>
                            <th>Additional Charge</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php if(isset($customer_orders) && $customer_orders->count()>0): ?>
                    <?php $__currentLoopData = $customer_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $customer = $customers->where("customer_id",$customer_order->customer_id)->first();
                        ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td><?php echo e($customer_order->sr_no); ?></td>
                            <td><?php echo e($customer_order->date); ?></td>
                            <td><?php echo e($customer->fullname); ?></td>                            
                            <td><?php echo e($customer_order->from); ?></td>                            
                            <td><?php echo e($customer_order->vehicle); ?></td>                                                        
                            <td><?php echo e($customer_order->additional_charge); ?></td>
                            <td>                                
                                <a href="<?php echo e(route('admin.inwards.edit',$customer_order->customer_order_id)); ?>" title="Edit"><button class="btn btn-outline-info btn-icon-only btn-sm mb-2"><i class="la la-pencil"></i></button></a> &nbsp;
                                <button class="btn btn-outline-danger btn-icon-only btn-sm mb-2" onclick="deleteCustomerOrder( '<?php echo e(route('admin.inwards.destroy',$customer_order->customer_order_id)); ?>','<?php echo e($customer_order->customer_order_id); ?>' );" title="Delete"><i class="la la-trash"></i></button> &nbsp;                                                                
                                <a href="<?php echo e(route('admin.inwards.showReceipt',$customer_order->customer_order_id)); ?>" title="Receipt"><button class="btn btn-outline-dark btn-icon-only btn-sm mb-2"><i class="ti ti-printer"></i></button></a> &nbsp;                                  
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    
                <?php else: ?>
                        <tr>
                            <td colspan="12">
                                <div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div>
                            </td>
                        </tr>        
                <?php endif; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-right">                    
                        <div><b>Sub Total: <?php echo e(Helper::formatAmount($customer_orders->sum('additional_charge'))); ?> &nbsp;&nbsp; Total Additional Charge: <?php echo e(Helper::formatAmount($total_additional_charge)); ?></b></div>                    
                    </div>
                </div>
                <div class="flexbox mb-4 mt-4 noprint">
                    <div class="form-inline noprint">                        
                        <div><?php if ($__env->exists('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])) echo $__env->make('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>
                    </div>
                    <div class="flexbox noprint">
                        <?php if($request->all()): ?>
                            <?php echo $customer_orders->appends($request->all())->links(); ?>

                        <?php else: ?>
                            <?php echo $customer_orders->links(); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <?php echo Html::script('/assets/admin/js/inwards/index.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/inwards/index.blade.php ENDPATH**/ ?>