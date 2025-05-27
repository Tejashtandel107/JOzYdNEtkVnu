<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')); ?>

     <style type="text/css">
        .badge-pink[href]:focus, .badge-pink[href]:hover {
          color: #fff;
          background-color: #ff2770;
          border-color: #ff2770;
          -webkit-box-shadow: none;
          box-shadow: none;
          background-image: none;
        }
        .flex-grow-1{
          flex-grow: 1;
        }
        .border-bottom-1{
          border-bottom: 1px solid #e1eaec;
        }
        
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagetitle',"Dashboard"); ?>

<?php $__env->startSection('pagecontent'); ?>
<!-- START PAGE CONTENT-->
<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content fade-in-up">
    <div id="notify"></div>
    <div class="row">
      <div class="col-lg-7">
          <div class="card mb-3">
            <div class="card-body px-0 py-2">
                <div class="d-flex flex-wrap px-3 justify-content-between  align-items-center">
                  <div>
                  <?php echo e(Form::model($request,array('url' =>route('admin.dashboard'),'method'=>'get','id'=>'form-filter','autocomplete' => 'off'))); ?>

                      <div class="d-flex flex-wrap  align-items-center">
                            <div class="mb-2 mr-2">
                                <label class="pr-1">Date Range:</label>
                                <div class="input-group date">
                                    <?php echo Form::text('from',($request->from) ?? Helper::DateFormat(now()->firstOfMonth(),config('constant.DATE_FORMAT_SHORT')), array('class' => 'form-control datepicker w-150','placeholder' => 'From')); ?>

                                    <span class="input-group-addon pl-2 pr-2">to</span>
                                    <?php echo Form::text('to',($request->to) ?? Helper::DateFormat(today(),config('constant.DATE_FORMAT_SHORT')), array('class' => 'form-control datepicker w-150','placeholder' => 'To')); ?>

                                </div>
                          </div>
                          <div class="mr-2 mb-2">
                            <label class="pr-1">Customer:</label>
                            <?php echo Form::select('c', (array(""=>"All Customers") + $customers->pluck('fullname','customer_id')->toArray()), null , ['class' => 'form-control']); ?>

                          </div>
                          <div class="mb-2 align-self-end mr-2">
                              <a class="btn btn-primary" href="javascript:void(0)" onclick="formsubmit('<?php echo e(route('admin.dashboard')); ?>')">Get Report</a>
                          </div>
                      </div>
                  <?php echo e(Form::close()); ?>   
                  </div> 
                </div>    
            </div>
        </div>
        <div id="dashboard-main">
        
        </div>
      </div>
      <div class="col-lg-5">
        <div id="dashboard-left">
        
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('plugin-scripts'); ?>
    <?php echo Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>    
    <?php echo Html::script('/assets/app/vendors/jquery-slimscroll/jquery.slimscroll.min.js'); ?>    
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
      function formsubmit(url){
        var formdata = $("#form-filter").serialize();
        ajaxFetch(url,formdata,formSubmitResponse,formSubmitErrorResponse);
      }
      function formSubmitResponse(response, status){
        hideLoader();
        $("#dashboard-main").html(response);
        $('.datepicker').each(function(){
            bindDatePicker($(this));
        });
      }
      function formOutStandingsubmit(url){
        var formdata = $("#form-filter").serialize();
        ajaxFetch(url,formdata,formOutStandingResponse,formSubmitErrorResponse);
      }
      function formOutStandingResponse(response, status){
        hideLoader();
        $("#dashboard-left").html(response);
      }
      function binddatepicker() {
          $('.datepicker').each(function(){
              bindDatePicker($(this));
          });
      }
      function formSubmitErrorResponse(XMLHttpRequest, textStatus, errorThrown){
        hideLoader();
        $("#notify").notification({caption: 'Sorry, We have encountered an error while processing your request. Please try again after some time.', type:'error', sticky:true});
      }
      $(function () {
          formsubmit("<?php echo route('admin.dashboard');?>");
          formOutStandingsubmit("<?php echo route('admin.outstanding-payments');?>");
          binddatepicker();
      });
    </script>
<?php $__env->stopSection(); ?>    

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>