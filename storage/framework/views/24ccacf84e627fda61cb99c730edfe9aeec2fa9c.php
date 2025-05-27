<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-css'); ?>
    <?php echo Html::style('/assets/web/css/reports/insurance-reports.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
<!-- Page Heading Breadcrumbs -->
<?php echo $__env->make('web.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div class="ibox mb-2 noprint">
        <div class="ibox-body py-3">
        <?php echo Form::hidden('customer_id', (isset($customer_id) ? $customer_id : null) , array('id' => 'customer_id')); ?>

        <?php echo e(Form::model($request ,['method'=>'GET','route' => ['user.reports.insurance-report.show'],'id'=>"insurance-form"])); ?>

            <div id="notify"></div>
            <div class="row">                                  
                <div class="col-lg-12 col-md-12 col-sm-12 noprint">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-wrap">
                            <div class="mr-2 mb-2" style="width: 270px;">
                                <label class="pr-1">Date Range:</label>
                                <div class="input-group date">
                                    <?php echo Form::text('from', null , array('class' => 'form-control datepicker','required' => true,'placeholder' => 'From','autocomplete'=>'off')); ?>

                                    <span class="input-group-addon pl-2 pr-2">to</span>
                                    <?php echo Form::text('to', null , array('class' => 'form-control datepicker','placeholder' => 'To','autocomplete'=>'off')); ?>

                                </div>        
                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Item:</label>
                                <?php echo Form::select('i', (array(""=>"Select") + $items->pluck('name','item_id')->toArray()), null , ['class' => 'form-control','onchange'=>'fetchMarka(this)']); ?>

                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Marka:</label>
                                <?php echo Form::select('m', (array(""=>"Select") + $markas->pluck('name','marka_id')->toArray()), null , ['class' => 'form-control','id'=>'marka_id']); ?>

                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Search</label>
                                <div class="input-group-icon input-group-icon-left">
                                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                    <?php echo Form::text('q',null, array('class' => 'form-control','placeholder' => 'Vakkal,Item,Marka')); ?>

                                </div>
                            </div>  
                            <div class="mb-2 align-self-end">
                                <input type="submit" class="btn btn-primary" href="javascript:void(0)" onclick="formsubmit()" value="Filter">  
                            </div>
                        </div>                          
                    </div>                  
                </div>    
            </div>            
        <?php echo e(Form::close()); ?>   
        </div>
    </div>   
    <div class="ibox" id="printbox">
        <div class="ibox-body text-right">
            <a class="btn btn-dark noprint" href="javascript:void(0)" onclick="printReport();"><i class="fa fa-print"></i> Print</a>
            <div>
            <?php if(!count($request->all())>0): ?>
                <div class="text-left mt-3 alert alert-danger has-icon"><i class="la la-warning alert-icon noprint"></i> Please select any filters to generate report. </div>                
            <?php elseif(isset($results) && ($results->count() > 0)): ?>
            <?php            
                $full_ledgers = $results->groupBy('customer_id');
            ?>                 
                <?php $__currentLoopData = $full_ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insurance_results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php                
                $customer_info = $insurance_results->first();
            ?>
                <div class="main-wrapper">
                    <div class="text-center">
                        <div class="text-center top-title ">|| <?php echo e($company_info->gods_quotes); ?> ||</div>
                        <div class="border border-black main-wrapper mb-2">
                            <div class="border-bottom">
                                <div class="text-center font-20 font-weight-bold print-title">Statement Of Insurance</div>
                            </div>
                            <div class="text-center p-2 print-padding border-bottom">
                                <div class="pb-1 font-weight-bold font-20">
                                    <?php echo e(strtoupper($company_info->companyname)); ?>

                                </div>
                                <div class="font-weight-bold font-17">
                                    <?php echo e(strtoupper($company_info->address)); ?>

                                </div>
                            </div>

                            <table class="w-100">
                                <thead>
                                    <tr class="text-left">
                                        <td colspan="10" class="p-2 print-padding border-right" style="width: 55.8%;">
                                            <div><span class="font-weight-bold">M/S.</span>:&nbsp;&nbsp; <?php echo e($customer_info->companyname); ?></div>
                                            <div><span class="font-weight-bold">Address</span>:&nbsp;&nbsp;<?php echo e($customer_info->address); ?></div>
                                        </td>
                                        <td class="p-2 print-padding" colspan="2">
                                            <div class="print-p-b-0"><span class="font-weight-bold">For The Period of :</span>&nbsp;
                                                <span>
                                                    <?php if($period->count() > 0): ?>
                                                    <?php
                                                        $startmonth = $period->getStartDate()->format('F,Y');
                                                        $endmonth = $period->getEndDate()->format('F,Y'); 
                                                    ?>
                                                        <?php echo e(($startmonth == $endmonth) ? $endmonth : $startmonth .' to '.$endmonth); ?>

                                                    <?php else: ?>
                                                        NULL
                                                    <?php endif; ?>
                                                </span>                                    
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="w-100" border="1">
                                <thead>
                                    <tr>
                                        <td class="text-center font-weight-bold p-2 header-bg border-left">Vakkal No.</td>
                                        <td class="text-center font-weight-bold header-bg">Item</td>
                                        <td class="text-center font-weight-bold header-bg">Marka</td>
                                        <td class="text-center font-weight-bold header-bg">Quantity</td>
                                        <td class="text-center font-weight-bold header-bg">Total Weight</td>
                                        <td class="text-center font-weight-bold header-bg">Rate</td>
                                        <td class="text-center font-weight-bold header-bg">Valuation</td>
                                        <td class="text-center font-weight-bold header-bg">Month</td>
                                        <td class="text-center font-weight-bold header-bg">Insurance Rate</td>
                                        <td class="text-center font-weight-bold header-bg">Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $total_valuation = 0;
                                    $total_amount = 0;
                                ?>    
                                <?php $__currentLoopData = $insurance_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                    $balance_quantity = $result->inwards - $result->outwards;
                                    $total_weight = $balance_quantity * $result->weight;
                                    $valuation = $total_weight * $result->item_rate;
                                    $amount = ($valuation/100000)*$result->insurance_rate;
                                    $total_valuation += $valuation;
                                    $total_amount += $amount;
                                 ?>
                                    <tr class="text-center">
                                        <td class="border-left"><?php echo e($result->vakkal_number); ?></td>
                                        <td><?php echo e($result->item_name); ?></td>
                                        <td><?php echo e($result->marka_name); ?></td>
                                        <td><?php echo e($balance_quantity); ?></td>
                                        <td><?php echo e($total_weight); ?></td>
                                        <td><?php echo e($result->item_rate); ?></td>
                                        <td><?php echo e($valuation); ?></td>
                                        <td><?php echo e($result->Month); ?> - <?php echo e($result->Year); ?></td>
                                        <td><?php echo e($result->insurance_rate); ?></td>
                                        <td><?php echo e(Helper::formatAmount($amount)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td class="border-left" colspan="3"></td>
                                        <td class="font-weight-bold">Total</td>
                                        <td class="font-weight-bold header-bg"><?php echo e($insurance_results->sum('total_balance_weight')); ?></td>
                                        <td></td>
                                        <td class="font-weight-bold header-bg"><?php echo e(Helper::formatAmount($total_valuation)); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-bold header-bg"><?php echo e(Helper::formatAmount($total_amount)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="text-left mt-3 alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon noprint"></i> No data found to generate report. </div>                
            <?php endif; ?>           
                
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('plugin-scripts'); ?>
    <?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <?php echo Html::script('/assets/web/js/reports/insurance.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/web/reports/insurance.blade.php ENDPATH**/ ?>