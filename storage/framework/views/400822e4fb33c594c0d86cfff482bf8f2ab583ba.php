<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('page-css'); ?>
    <?php echo Html::style('/assets/admin/css/reports/stocks-reports.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagecontent'); ?>
<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div class="ibox mb-2 noprint">
        <div class="ibox-body py-3" style="color: #000">
        <?php echo e(Form::model($request,array('url' =>route('admin.reports.stock-report.show'),'method'=>'get','id'=>'form-filter'))); ?>

            <div class="flexbox">
                <div class="flexbox noprint">
                    <div class="form-group mr-2">                        
                        <label class="pr-1">Chamber:</label>
                        <?php echo Form::select('ch', (array(""=>"Select Chamber","all"=>"View All") + $chambers), null , ['class' => 'form-control','onchange'=>'formsubmit()']); ?>                        
                    </div>
                    <div class="form-group">                        
                        <label class="pr-1">Floor:</label>
                        <?php echo Form::select('fl', (array(""=>"Select Floor","all"=>"View All") + $floors), null , ['class' => 'form-control','onchange'=>'formsubmit()']); ?>

                    </div>
                </div>                
            </div>
        <?php echo e(Form::close()); ?>

        </div>
    </div>
    <div class="ibox" id="printbox">
        <div class="ibox-body" style="color: #000">
            <div class="noprint text-right">
                    <a class="btn btn-dark" href="javascript:void(0)" onclick="printReport();"><i class="fa fa-print"></i> Print</a>
            </div>                                                                
            <div class="text-center top-title">|| <?php echo e($company_info->gods_quotes); ?> ||</div>
            <div class="border border-black d-flex align-items-center justify-content-between p-2 print-padding">
              <div class="col">GSTIN: <?php echo e($company_info->gstnumber); ?></div>
              <div class="col text-center font-weight-bold font-20 print-title">Storage Capacity</div>
              <div class="col text-right">Contact: <?php echo e($company_info->phone); ?></div>
            </div> 
            <div class="text-center p-3 border-bottom border-right border-left print-padding">
                <div class="pb-1 font-weight-bold font-20 print-title">
                    <?php echo e(strtoupper($company_info->companyname)); ?>

                </div>
                <div>
                    <?php echo e($company_info->address); ?>

                </div>
            </div>
    <?php if(($request->filled('ch')) || ($request->filled('fl'))): ?>    
        <?php
            $end_chamber_loop = (($request->filled('ch')) && $request->input('ch') !="all") ? $request->input('ch') : count($chambers);
            $end_floor_loop = (($request->filled('fl')) && $request->input('fl') !="all") ? $request->input('fl') : count($floors);
            $start_chamber_loop = (($request->filled('ch')) && $request->input('ch') !="all") ? $request->input('ch') : 1 ;
            $start_floor_loop = (($request->filled('fl')) && $request->input('fl') != "all") ? $request->input('fl') : 1 ;
            $count = 1;
        ?>
        <div class="d-block">
         <?php for($chamber=$start_chamber_loop; $chamber<=$end_chamber_loop; $chamber++): ?>
            <?php for($floor=$start_floor_loop; $floor <=  $end_floor_loop; $floor++): ?>
                <div class="d-inline-block" style="width: 100%;">
                    <div class="border-right border-bottom border-top my-3">
                        <div>
                            <div class="header-bg p-2 font-weight-bold text-center border-bottom border-left">Chamber - <?php echo e($chambers[$chamber]); ?> Floor - <?php echo e($floors[$floor]); ?></div>
                            <div class="d-flex font-weight-bold border-left justify-content-between">
                                <div class="pl-2">Total</div>
                            <?php 
                                $totalinwards_quantity = $results->where('chamber_id',$chamber)->where('floor_id',$floor)->sum('totalinwards');
                                $totaloutwards_quantity = $results->where('chamber_id',$chamber)->where('floor_id',$floor)->sum('totaloutwards');                                
                            ?>    
                                <div class="pr-2"> <?php echo e($totalinwards_quantity - $totaloutwards_quantity); ?></div>
                            </div>
                        </div>
                        <div style = "display: grid; grid: repeat(5, 30px) / auto-flow;">
                    <?php for($grid=count($grids); $grid>=1; $grid--): ?>
                        <?php 
                            $result = $results->where('chamber_id',$chamber)->where('floor_id',$floor)->where('grid_id',$grid)->first();   
                            $remaining_quantity = (isset($result->totalinwards) ? $result->totalinwards : 0) - (isset($result->totaloutwards) ? $result->totaloutwards : 0);                                    ;
                        ?>
                            <div class="d-flex text-center border-left border-top">
                                <div class="flex-grow align-self-center"><?php echo e($remaining_quantity); ?></div>
                                <div class="header-bg w-30" style="line-height: 30px"><span class="px-1">G<?php echo e(Helper::getGrigNumber($grids[$grid])); ?></span></div>    
                            </div>  
                    <?php endfor; ?>     
                        </div>
                    </div>
                </div>
            <?php if($count%2==0): ?>
                <div class="pagebreak"><!-- --></div>
            <?php endif; ?>
                <?php    
                    $count++
                ?>
            <?php endfor; ?>
        <?php endfor; ?>
        </div>
    <?php else: ?>
        <div class="mt-3 alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon noprint"></i> No data found to generate report. </div>
    <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <?php echo Html::script('/assets/admin/js/inwards/show.js'); ?>

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/reports/storage-capacity.blade.php ENDPATH**/ ?>