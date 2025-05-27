<?php
    $auth_user_id = Auth::id();
    $can_view_receipt = ($auth_user_id == $user->user_id and $user->customer_id == $customer_order->customer_id) ? true : false;
?>


<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('page-css'); ?>
    <?php echo Html::style('/assets/web/css/inwards/show-receipt.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
<?php echo $__env->make('web.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div class="ibox" id="printbox">
        <div class="ibox-body text-black">
            <?php if($can_view_receipt): ?>
            <div class="d-flex justify-content-end">
                <div class="noprint mb-3">
                    <a class="btn btn-dark" href="javascript:void(0)" onclick="printReport();"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>     
            <?php if(isset($order_items) && $order_items->count() > 0): ?>
                <?php
                    $i = 0;
                    $page = 1;
                    $total_page = $order_items->chunk(5)->count();
                ?>
            <?php $__currentLoopData = $order_items->chunk(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border border-black main-wrapper <?php echo e(($loop->first) ? '' : 'print-margin-top pagebreak'); ?>">
                
                <div class="d-flex align-items-center justify-content-between p-1 border-bottom">
                    <div class="col"></div>
                    <div class="col text-center top-title">|| <?php echo e($company_info->gods_quotes); ?> ||</div>
                    <div class="col text-right">Page <?php echo e($page++); ?> of <?php echo e($total_page); ?></div>
                </div>
                <div class="d-flex border-bottom print-padding align-items-center">
                    <div class="col">GSTIN: <?php echo e($company_info->gstnumber); ?></div>
                    <div class="col text-center font-20 font-weight-bold print-title">INWARD CHALLAN</div>
                    <div class="col text-right">Contact: <?php echo e($company_info->phone); ?></div>
                </div>
                <div class="text-center p-2 print-padding border-bottom">
                    <div class="pb-1 font-weight-bold font-20">
                        <?php echo e(strtoupper($company_info->companyname)); ?>

                    </div>
                    <div>
                        <?php echo e($company_info->address); ?>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="w-100">
                        <thead>
                            <tr class="border-bottom">
                                <td colspan="7" class="border-right p-1 print-padding">
                                    <div class="pb-1">
                                        Party name : &nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->fullname); ?></span>
                                    </div>
                                    <div class="pb-3">
                                        Address:&nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->customer_add); ?></span>
                                    </div>
                                    <div>From : &nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->from); ?></span></div>
                                </td>
                                <td class="p-1 print-padding" colspan="3">
                                    <div class="pb-1 print-p-b-0">Date : &nbsp;&nbsp;<span class="font-weight-bold">
                                        <?php echo e($customer_order->date); ?></span>                                    
                                    </div>
                                    <div class="pb-1 print-p-b-0">
                                        Sr. No.: &nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->sr_no); ?></span>
                                    </div>
                                    <div class="pb-1 print-p-b-0">
                                        Transporter: &nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->transporter); ?></span>
                                    </div>
                                    <div>
                                        Vehicle No : &nbsp;&nbsp;<span class="font-weight-bold"><?php echo e($customer_order->vehicle); ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="font-weight-bold text-center border-bottom">
                                <td style="width: 41px" class="border-right text-center" rowspan="2">No#</td>
                                <td class="border-right text-center" rowspan="2">Item-Marka</td>
                                <td class="border-right text-center w-100px" rowspan="2">Details</td>        
                                <td class="w-15 border-right text-center" rowspan="2">Vakkal NO.</td>
                                <td class="w-20 border-right border-bottom text-center" colspan="3">Location Code</td>
                                <td class="w-10 border-right text-center" rowspan="2">Weight (KG)</td>
                                <td class="w-10 border-right text-center" rowspan="2">Quantity</td>
                                <td class="text-center" rowspan="2">Total <br> weight</td>
                            </tr>
                            <tr class="font-weight-bold text-center border-bottom">
                                <td class="text-center border-right">CH.</td>
                                <td class="text-center border-right">Floor</td>
                                <td class="text-center border-right">Grid</td>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                        $additional_change = $customer_order->additional_charge;
                    ?>
                    <?php if(isset($order_items) && $order_items->count() > 0): ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $i++;
                            ?>
                            <tr class="text-center">
                                <td class="border-right"><?php echo e($i); ?></td>
                                <td class="border-right"><?php echo e($order_item->item_name); ?>-<?php echo e($order_item->marka_name); ?></td>
                                <td class="border-right"><?php echo e($order_item->description); ?></td>
                                <td class="border-right"><?php echo e($order_item->vakkal_number); ?></td>
                                <td class="border-right"><?php echo e($order_item->chamber_number); ?></td>
                                <td class="border-right"><?php echo e($order_item->floor_number); ?></td>
                                <td class="border-right"><?php echo e(Helper::getGrigNumber($order_item->grid_number)); ?></td>
                                <td class="border-right"><?php echo e($order_item->weight); ?></td>
                                <td class="border-right"><?php echo e($order_item->quantity); ?></td>
                                <td><?php echo e($order_item->total_weight); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($items->count() < 5): ?>
                            <?php for($i=1;$i<=5-$items->count(); $i++): ?>
                            <tr class="text-center">
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td class="border-right"></td>
                                <td>0.00</td>
                            </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                        $total_weight = $items->sum('total_weight');
                    ?>
                            <tr class="border-top print-remark">
                                <td class="border-right" colspan="7">Remark: <span class="notes"><?php echo e(substr($customer_order->notes,0,90)); ?></span></td>                            
                                <td class="border-bottom border-right text-center"><b>TOTAL</b></td>
                                <td class="border-bottom border-right text-center"><b><?php echo e(Helper::formatAmount($items->sum('quantity'))); ?></b></td>
                                <td class="border-bottom text-right"><b><?php echo e(Helper::formatAmount($total_weight)); ?></b></td>                            
                            </tr>
                            <tr class="print-remark">   
                                <td class="border-right pl-2" colspan="7">* We only consider average weight of package by checking few of them</td>
                                <td class="border-right border-bottom text-right" colspan="2"><b>Additional Charge:</b></td>                            
                                <td class="border-bottom text-right"><b><?php echo e(($loop->first) ? Helper::formatAmount($additional_change) : Helper::formatAmount(0)); ?></b></td>
                            </tr>
                            <tr class="print-remark">
                                <td class="border-right pl-2" colspan="10">* all the items condition and location verify by sender sign</td>
                            </tr>
                        </tbody>
                    </table>
                </div>    
                <div class="pl-2 border-bottom print-remark">
                    <div>* ones goods arrives, sender would be bound by terms & conditions</div>
                    <div class="font-weight-bold pt-1">*Please, read the terms and condition at back side before sign.</div>
                </div>
                <div class="p-3 print-padding print-padding">
                    <div class="text-right pr-3">
                        <b>For, <?php echo e(ucwords(strtolower($company_info->companyname))); ?></b>
                    </div>
                    <div class="pt-3 d-flex justify-content-between">
                        <div class="flex-grow pl-5">Transporter Sign.</div>
                        <div class="flex-grow text-center">Party Sign.</div>
                        <div class="flex-grow text-right pr-3">Authorised Signature</div>
                    </div>
                </div>
            </div>
            <!-- <div class="pagebreak"></div> -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>                 
        <?php else: ?>
            <div class="text-left mt-3 alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon noprint"></i> Access is denied. </div>
        <?php endif; ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <?php echo Html::script('/assets/web/js/inwards/show.js'); ?>

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

<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/inwards/show-receipt.blade.php ENDPATH**/ ?>