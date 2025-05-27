@php
    $counter = $first_item = intval($customer_orders->firstItem());
    $last_item = intval($customer_orders->lastItem());
    $total_records = $customer_orders->total();
@endphp

@extends('web.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/dataTables/datatables.min.css') }}
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
@endsection

@section('pagetitle',$pagetitle)

@section('pagecontent')
<!-- Page Heading Breadcrumbs -->
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
    <div class="ibox mb-2">
        <div class="ibox-body py-3">
        {{ Form::model($request, array('url' =>route('user.outwards.index'),'method'=>'get','id'=>'form-filter','autocomplete'=>'off')) }}
            <div id="notify"></div>
            <div class="flexbox mb-2">
                <div class="col-lg-12 p-0">
                    <div class="d-flex flex-wrap pull-right">
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Date Range:</label>
                            <div class="input-group date">
                                {!! Form::text('from', null , array('class' => 'form-control datepicker','placeholder' => 'From')) !!}
                                <span class="input-group-addon pl-2 pr-2">to</span>
                                {!! Form::text('to', null , array('class' => 'form-control datepicker','placeholder' => 'To')) !!}
                            </div>
                        </div>
                        <div class="mr-2 mb-2">
                            <label class="pr-1">Filter Records:</label>
                            {!! Form::select('f', (array(""=>"Show All","ac"=>"Only Additional Charge")), null , ['class' => 'form-control','onchange'=>'formsubmit()']) !!}
                        </div>
                        <div class="mr-2 mb-2">                                
                            <label class="pr-1">Search:</label>
                            <div class="input-group-icon input-group-icon-left">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                {!! Form::text('s',null, array('class' => 'form-control','placeholder' => 'Search Serial Number')) !!}
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
                    {!! Form::select('p', (array("50"=>"50","100"=>"100","150"=>"150","200"=>"200","300"=>"300")), $show , ['class' => 'form-control mr-2', 'onchange'=>'formsubmit()']) !!}
                    <div>@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-dark btn-rounded btn-air mb-2" onclick="printList('{{ route('user.outwards.print',$request->all()) }}')" href="javascript:void(0)"><i class="fa fa-print"></i> Print </a>
                </div>
            </div>
        {{ Form::close() }}
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-default thead-lg">
                        <tr>
                            <th>#</th>
                            <th>Serial No.</th>
                            <th>Outward Date</th>
                            <!-- <th>Customer</th> -->
                            <th>Vehicle Number</th>            
                            <th>Delivered To</th>            
                            <th>Additional Charge</th>       
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                @if(isset($customer_orders) && $customer_orders->count()>0)
                    @foreach($customer_orders as $customer_order)
                        <?php
                            $customer = $customers->where("customer_id",$customer_order->customer_id)->first();
                        ?>
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $customer_order->sr_no }}</td>
                            <td>{{ $customer_order->date }}</td>
                            <!-- <td>{{ $customer->fullname }}</td>   -->                          
                            <td>{{ $customer_order->vehicle }}</td>
                            <td>{{ $customer_order->delivery_address}}</td>
                            <td>{{ $customer_order->additional_charge }}</td>
                            <td>                                                                
                                <a href="{{ route('user.outwards.showReceipt',$customer_order->customer_order_id) }}" title="Receipt"><button class="btn btn-outline-dark btn-icon-only btn-sm mb-2"><i class="ti ti-printer"></i></button></a> &nbsp;                                  
                            </td>
                        </tr>
                    @endforeach                    
                @else
                        <tr>
                            <td colspan="12">
                                <div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div>
                            </td>
                        </tr>        
                @endif
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-right">                    
                        <div><b>Sub Total: {{ Helper::formatAmount($customer_orders->sum('additional_charge')) }} &nbsp;&nbsp; Total Additional Charge: {{ Helper::formatAmount($total_additional_charge) }}</b></div>                    
                    </div>
                </div>
                <div class="flexbox mb-4 mt-4 noprint">
                    <div class="form-inline noprint">
                        <div>@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                    </div>
                    <div class="flexbox noprint">
                        @if($request->all())
                            {!! $customer_orders->appends($request->all())->links() !!}
                        @else
                            {!! $customer_orders->links() !!}
                        @endif
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugin-scripts')
	{!! Html::script('/assets/app/vendors/dataTables/datatables.min.js') !!}
    {!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
@endsection

@section('page-scripts')
	{!! Html::script('/assets/web/js/outwards/index.js') !!}
@endsection
