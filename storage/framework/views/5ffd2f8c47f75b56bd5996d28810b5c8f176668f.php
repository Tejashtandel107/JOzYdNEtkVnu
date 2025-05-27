<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title><?php echo e(config('app.name')); ?> : Export Stocks</title>    
</head>
<body>    
<div class="ibox">
    <div class="ibox-body">                
<?php if(isset($results) && ($results->count() > 0)): ?>
<?php    
        $full_ledgers = $results->groupBy('customer_id');
?>        
        <?php $__currentLoopData = $full_ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger_results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php    
        $customer_info = $ledger_results->first();        
?>
        <div class="table-responsive">
            <table class="w-100">
                <thead>
                    <tr>
                        <td>Customer:</td>
                        <td><?php echo e($customer_info->fullname); ?></td>
                        <td colspan="1"></td>
                        <td>Stock data till:</td>
                        <td colspan="4">
                            <?php echo e(Helper::DateFormat($ledger_results->min('order_date'),'d/m/Y')); ?> to <?php echo e(Helper::DateFormat($ledger_results->max('order_date'),'d/m/Y')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>Type</td>
                        <td>Sr.No.</td>
                        <td>Item</td>
                        <td>Marka</td>
                        <td>Vakkal No.</td>
                        <td>Location Code</td>
                        <td>Weight</td>
                        <td>Quantity</td>
                        <td>Outstanding Quantity</td>
                        <td>Outstanding Weight</td>
                    </tr>
                </thead>
                <tbody>                    
<?php
                $chambers = App\Models\Chamber::all()->keyBy('chamber_id');
                $floors = App\Models\Floor::all()->keyBy('floor_id');
                $grids = App\Models\Grid::all()->keyBy('grid_id');
?>
                <?php $__currentLoopData = $ledger_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php            
                    $chamber = $chambers->get($result->chamber_id);
                    $floor = $floors->get($result->floor_id);
                    $grid = $grids->get($result->grid_id);
?>
                    <tr>
                        <td><?php echo e(Helper::DateFormat($result->order_date,config('constant.DATE_FORMAT_SHORT'))); ?></td>
                        <td><?php echo e($result->type); ?></td>
                        <td><?php echo e($result->sr_no); ?></td>
                        <td><?php echo e($result->item_name); ?></td>                            
                        <td><?php echo e($result->marka_name); ?></td>                            
                        <td><?php echo e($result->vakkal_number); ?></td>
                        <td><?php echo e(Helper::getLocationCode( (($chamber) ? $chamber->number : ' -- '),(($floor) ? $floor->number : ' -- '),(($grid) ? $grid->number : ' -- ') )); ?></td>                        
                        <td><?php echo e($result->weight); ?></td>
                        <td><?php echo e($result->quantity); ?></td>
                        <td><?php echo e($result->total_inward-$result->total_outward); ?></td>                                                        
                        <td><?php echo e($result->total_balance_weight); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr>
            <td colspan="12">
                <div> No records found. </div>
            </td>
        </tr>        
        <?php endif; ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/reports/inc/export.blade.php ENDPATH**/ ?>