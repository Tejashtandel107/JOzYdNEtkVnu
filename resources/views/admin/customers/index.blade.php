@php
    $counter = $first_item = intval($customers->firstItem());
    $last_item = intval($customers->lastItem());
    $total_records = $customers->total();
@endphp

@extends('admin.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/dataTables/datatables.min.css') }}
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
@endsection

@section('pagetitle',$pagetitle)

@section('pagecontent')
<!-- Page Heading Breadcrumbs -->
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <div id="notify"></div>
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <div class="mb-3">@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                <div class="d-flex flex-wrap">
                    <div class="flex-grow mb-2">
                        {{ Form::model($request,array('url' =>route('admin.customers.index'),'method'=>'get','id'=>'form-filter')) }}
                        <div class="input-group-icon input-group-icon-left mr-3">
                            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                            {!! Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')) !!}
                        </div>
                        {{ Form::close() }}
                    </div>    
                    <div class="flex-grow text-right">
                        <a class="btn btn-rounded btn-primary btn-air" href="{{ route('admin.customers.create') }}">Add Customer</a>
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
                @if(isset($customers) && $customers->count()>0)
                    @foreach($customers as $customer)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>
                                <div>{{ $customer->fullname }}</div>
                                @if(isset($customer->address) && !empty($customer->address))
                                    <small class="text-muted">
                                        <a href="https://maps.google.com/?q={{$customer->address}}" target="_blank"><i class="fas fa-map-marker-alt"></i>&nbsp;{{ $customer->address }}&nbsp;</a><br>
                                    </small>
                                @endif
                                @if(isset($customer->phone) && !empty($customer->phone))
                                <small class="text-muted">
                                    <a href="tel:{{ $customer->phone }}"><i class="fa fa-phone"></i>&nbsp;{{ $customer->phone }}&nbsp;</a>
                                </small>
                                @endif
                                @if(isset($customer->contact_person) && !empty($customer->contact_person))
                                <small class="text-muted"><i class="fa fa-user"></i>&nbsp;{{ $customer->contact_person }}</small>
                                @endif
                            </td>
                            <td>{{ $customer->gstnumber }}</td>
                            <td>
                                {{ Form::model($customer ,['method'=>'PATCH' , 'files'=>true, 'route' => ['admin.customers.update', $customer->customer_id],'id'=>"submit_form_".$customer->customer_id]) }}
                                <div class="d-flex flex-wrap">
                                    <div class="mb-2 mr-3 w-170">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                            </div>
                                            {!! Form::text('last_invoice_date',null, array('class' => 'form-control datepicker', 'placeholder' => 'Last Invoice Date','required'=>true)) !!}                            
                                        </div>    
                                    </div>
                                    <div class="mb-2 mr-3 w-170">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <div class="input-group-text"><i class="fas fa-rupee-sign"></i></div>
                                            </div>
                                            {!! Form::text('invoice_limit',null, array('class' => 'form-control', 'placeholder' => 'Invoice Limit','required'=>true)) !!}                            
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        {!! Form::button('Save', array('class' => 'btn btn-info','id'=>"submitbtn","onclick"=>"SubmitFunction($customer->customer_id,this);")) !!}
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </td>
                            <td>@includeIf('admin.inc.status', ['status' => $customer->isactive])</td>
                            <td>
                                <a href="{{ route('admin.customers.edit',$customer->customer_id) }}" title="Edit">
                                    <button class="btn btn-outline-info btn-sm mb-1"><i class="la la-pencil"></i> Edit </button>
                                </a> &nbsp;
                                <button class="btn btn-outline-danger btn-sm mb-1" onclick="deleteCustomer( '{{ route('admin.customers.destroy',$customer->customer_id) }}','{{ $customer->customer_id }}' );" title="Delete">
                                    <i class="la la-trash"></i> Delete 
                                </button> &nbsp;
                            </td>
                        </tr>
                    @endforeach
                @else
                        <tr>
                            <td colspan="12"><div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div></td>
                        </tr>
                @endif
                    </tbody>
                </table>
                <div class="flexbox mb-4 mt-4 noprint">
                    <div class="form-inline noprint">                        
                        <div>@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                    </div>
                    <div class="flexbox noprint">
                        @if($request->filled('keyword'))
                            {!! $customers->appends(['keyword'=>$request->keyword])->links() !!}
                        @else
                            {!! $customers->links() !!}
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
    
    {!! Html::script('/assets/app/js/plugin/jquery.buttonSpinner.js') !!}
    
@endsection

@section('page-scripts')
	{!! Html::script('/assets/admin/js/customers/index.js') !!}
@endsection
