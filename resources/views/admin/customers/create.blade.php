@extends('admin.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection
@section('page-css')
    <style type="text/css">
        .flex-grow-1 {
            flex-grow: 1;
        }
    </style>
@endsection
@section('pagetitle',$pagetitle)

@section('pagecontent')
<!-- Page Heading Breadcrumbs -->
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="{{(isset($customer)) ? 'col-lg-7' : 'col-lg-8'}}" id="customer-details">
            <div class="ibox ibox-fullheight">
                <div class="ibox-head">
                    <div class="ibox-title">Customer Information</div>
                </div>
                @if(isset($customer))
                    {{ Form::model($customer ,['method'=>'PATCH' , 'files'=>true, 'route' => ['admin.customers.update', $customer->customer_id],'id'=>"customer-form"]) }}
                @else
                    {!! Form::open(array('files'=>true, 'route' => 'admin.customers.store', 'id' => 'customer-form','autocomplete' => 'off')) !!}
                @endif
                <div class="ibox-body">
                    <div id="notify"></div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            {!! Form::label('companyname', 'Company Name') !!}
                            {!! Form::text('companyname',null, array('class' => 'form-control', 'placeholder' => 'Company Name')) !!}                        
                            @if ($errors->has('companyname'))
                                <small class="error">{{ $errors->first('companyname') }}</small>
                            @endif
                        </div> 
                        <div class="col-md-6 form-group mb-4">
                            {!! Form::label('contact_person', 'Contact Person') !!}
                            {!! Form::text('contact_person',null, array('class' => 'form-control', 'placeholder' => 'Contact Person','maxlength'=>255)) !!}                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 form-group">
                            {!! Form::label('phone', 'Phone') !!}
                            <div class="input-group mb-2 date">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                {!! Form::text('phone',null, array('class' => 'form-control', 'placeholder' => 'Phone','maxlength'=>15)) !!}                        
                            </div>    
                        </div>     
                        <div class="col-md-6 form-group mb-4">
                            {!! Form::label('gstnumber', 'GST Number') !!}
                            {!! Form::text('gstnumber',null, array('class' => 'form-control', 'placeholder' => 'GST Number','maxlength'=>255)) !!}                            
                        </div>    
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::textarea('address',null, array('class' => 'form-control', 'placeholder' => 'Address', 'rows'=>3)) !!}                        
                    </div>
                    <!-- <div class="form-group mb-4">
                        {!! Form::label('photo', 'Photo') !!}
                        <div>
                            {!! Form::file('photo',null, array('class' => 'form-control', 'placeholder' => 'Photo','required'=>true)) !!}                            
                        </div>
                    </div> -->
                    <div class="form-group mb-4">
                        {!! Form::label('isactive', 'Enable') !!}
                        <div>
                            <label class="radio radio-info radio-inline">
                                {!! Form::radio('isactive', config('constant.status.active'), true) !!}
                                <span class="input-span"></span>Yes
                            </label>
                            <label class="radio radio-info radio-inline">
                                {!! Form::radio('isactive', config('constant.status.inactive')) !!}
                                <span class="input-span"></span>No
                            </label>
                        </div>
                    </div>
                    <div class="card centered">
                        <div class="card-body">
                            <div class="card-avatar mb-4">
                                <img src="{{ isset($customer->photo)?$customer->photo: \Helper::getProfileImg('') }}" class="img-circle profile-img" alt="customer">                        
                            </div>
                            <div class="form-group">
                                    {!! Form::file('photo',null, array('class' => 'form-control', 'placeholder' => 'Photo','required'=>true)) !!}                            
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="ibox-footer">
                    {!! Form::submit('Save', array('class' => 'btn btn-info mr-2','id'=>"submitbtn")) !!}
                    <a href="{{route('admin.customers.index')}}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    @if(isset($customer))
        <div class="col-lg-5">
            <div class="ibox ibox-fullheight">
                <div class="ibox-head">
                    <div class="ibox-title">All Users</div>
                    <div>
                        <a class="btn btn-rounded btn-primary btn-air" href="{{ route('admin.user.create',$customer->customer_id) }}"><i class="ti-plus"></i>&nbsp;&nbsp;Create</a>
                    </div>
                </div>
                <div class="ibox-body">
                    <div id="deletenotify"></div>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 470px;">
                        <ul class="media-list media-list-divider mr-2 scroller" data-height="470px" style="overflow: hidden; width: auto; height: 470px;">
                    @if(isset($users) && ($users->count() > 0))
                        @foreach($users as $user)
                            <li class="media align-items-center"><a class="media-img" href="javascript:;"><img class="img-circle" src="{{$user->photo}}" alt="image" style="width: 54px;height: 54px;"></a>
                                <div class="media-body d-flex align-items-center">
                                    <div class="flex-1">
                                        <div>
                                            <span class="text-primary"><a href="{{ route('admin.user.edit',$user->user_id) }}"><b>{{$user->username}}</b></a></span>
                                            <span class="px-2">{{$user->fullname}}</span>
                                        </div>
                                        <small class="text-muted">{{$user->email}}</small>
                                    </div>
                                    <a href="{{ route('admin.user.edit',$user->user_id) }}" class="btn btn-sm btn-outline-info mb-1"><i class="la la-pencil"></i> Edit</a>&nbsp;
                                    <button class="btn btn-outline-danger btn-sm mb-1" onclick="deleteUser( '{{ route('admin.user.destroy',$user->user_id) }}','{{ $user->user_id }}' );" title="Delete">
                                        <i class="la la-trash"></i> Delete 
                                    </button> 
                                </div>
                            </li>
                        @endforeach      
                    @else
                        <li class="align-items-center">
                            <div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> Sorry, no users found. </div>
                        </li>
                    @endif    
                        </ul>
                        <div class="slimScrollBar" style="background: rgb(113, 128, 143); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 416.008px;"></div>
                        <div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.9; z-index: 90; right: 1px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="card text-center has-cup card-air centered mb-4">
                <div class="card-cup"></div>
                <div class="card-body">
                    <div class="card-avatar mb-4">
                        <img src="{{ $customer->photo }}" class="img-circle" alt="customer">                        
                    </div>
                    <h5 class="card-title text-primary mb-1">{{ $customer->companyname }}</h5>
                    <div class="text-muted">{{ $customer->phone }}</div>
                </div>
            </div>
        </div> -->
        @endif    
    </div>
</div>
@endsection

@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
@endsection

@section('page-scripts')
    {!! Html::script('/assets/admin/js/customers/create.min.js') !!}
    @if (session('type'))
        <script type="text/javascript">
    		@if(session('type')=="success")
    			$("#notify").notification({caption: "{{session('message')}}", sticky:false, type:'{{session('type')}}'});
    		@else
    			$("#notify").notification({caption: "{{session('message')}}", sticky:true, type:'{{session('type')}}'});
    		@endif

        </script>
    @endif
@endsection
