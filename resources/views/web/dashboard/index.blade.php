@extends('web.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
    <style type="text/css">
          
      .badge-pink[href]:focus, .badge-pink[href]:hover {
      color: #fff;
      background-color: #ff2770;
      border-color: #ff2770;
      -webkit-box-shadow: none;
      box-shadow: none;
      background-image: none;
    }
    </style>
@endsection

@section('pagetitle',"Dashboard")

@section('pagecontent')
<!-- START PAGE CONTENT-->
<div class="page-content fade-in-up">
    <div id="notify"></div>
    <div class="card mb-3">
        <div class="card-body px-0 py-2">
            <div class="d-flex flex-wrap px-3 justify-content-between  align-items-center">
              <div class="flex-grow heading mb-2">
                <h5 class="font-strong mb-0">Dashboard</h5>
              </div>
              <div>
              {{ Form::model($request,array('url' =>route('user.home'),'method'=>'get','id'=>'form-filter','autocomplete' => 'off')) }}
                  <div class="d-flex flex-wrap  align-items-center">
                        <div class="mb-2 mr-2">
                            <label class="pr-1">Date Range:</label>
                            <div class="input-group date">
                                {!! Form::text('from',($request->from) ?? Helper::DateFormat(now()->firstOfMonth(),config('constant.DATE_FORMAT_SHORT')), array('class' => 'form-control datepicker','placeholder' => 'From')) !!}
                                <span class="input-group-addon pl-2 pr-2">to</span>
                                {!! Form::text('to',($request->to) ?? Helper::DateFormat(today(),config('constant.DATE_FORMAT_SHORT')), array('class' => 'form-control datepicker','placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="mb-2 align-self-end mr-2">
                            <a class="btn btn-primary" href="javascript:void(0)" onclick="formsubmit('{{route('user.dashboard')}}')">Get Report</a>
                        </div>
                  </div>
              {{ Form::close() }}   
              </div> 
            </div>    
        </div>
    </div>
    <div id="dashboard-main">
    
    </div>
</div>
@endsection

@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}    
@endsection

@section('page-scripts')
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
          formsubmit("<?php echo route('user.dashboard');?>");
          binddatepicker();
      });
    </script>
@endsection    
