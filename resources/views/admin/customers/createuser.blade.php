
@extends('admin.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection
@section('page-css')
    <style type="text/css">
        .flex-grow-1 {
            flex-grow: 1;
        }
        .upload-profile img{
            max-width: 90px;
        }
    </style>
@endsection
@section('pagetitle',$pagetitle)

@section('pagecontent')
<!-- Page Heading Breadcrumbs -->
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="{{(isset($user)) ? 'col-lg-8' : 'col-lg-12'}}" id="user-details">
            <div class="ibox ibox-fullheight">
                <div class="ibox-head">
                    <div class="ibox-title">Profile Information</div>
                </div>
                @if(isset($user))
                    {{ Form::model($user ,['method'=>'PATCH' , 'files'=>true, 'route' => ['admin.user.update', $user->user_id],'id'=>"user-form"]) }}
                @else
                    {!! Form::open(array('files'=>true, 'route' => 'admin.user.store', 'id' => 'user-form','autocomplete' => 'off')) !!}
                @endif
                <div class="ibox-body">
                    <div id="notify"></div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">                            
                            <label>Customer</label>
                            <select class="form-control" name="customer_id">
                                <option value="">Select customer</option>
                            @foreach($customers as $customer)
                              <option value="{{$customer->customer_id}}" {{(isset($customer_id) && ($customer->customer_id == $customer_id)) ? 'selected="selected"' : ""}}>{{$customer->companyname}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('customer_id'))
                                <small class="error">{{ $errors->first('customer_id') }}</small>
                            @endif
                        </div>        
                        <div class="col-md-6 mb-4 form-group">
                            {!! Form::label('username', 'Username') !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="ti-user"></i></span>
                                {!! Form::text('username',null, array('class' => 'form-control', 'placeholder' => 'User Name')) !!}
                            </div>
                            <span class="help-block">The username can only consist of alphabetical, number and underscore.</span>
                            @if ($errors->has('username'))
                                <small class="error">{{ $errors->first('username') }}</small>
                            @endif
                        </div>
                    </div>
                    
                    <!-- <input type="hidden" name="customer_id" value="{{isset($customer_id) ? $customer_id : null}}"> -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            {!! Form::label('firstname', 'First Name') !!}
                            {!! Form::text('firstname',null, array('class' => 'form-control', 'placeholder' => 'First Name')) !!}                        
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            {!! Form::label('lastname', 'Last Name') !!}
                            {!! Form::text('lastname',null, array('class' => 'form-control', 'placeholder' => 'Last Name')) !!}                            
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('email', 'Email') !!}
                        <div class="input-group mb-3">
                            <span class="input-group-addon"><i class="ti-email"></i></span>
                            {!! Form::email('email',null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}
                        </div>
                        @if ($errors->has('email'))
                            <small class="error">{{ $errors->first('email') }}</small>
                        @endif
                        
                    </div>
                @if(!isset($user))
                    <div class="row">
                        <div class="col-md-6 orm-group mb-4">
                            {!! Form::label('newpassword', 'New Password') !!}
                            {!! Form::input('password','password',null, array('class' => 'form-control', 'placeholder' => 'Enter New Password','maxlength'=>15)) !!}
                            @if ($errors->has('password'))
                                <small class="error">{{ $errors->first('password') }}</small>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            {!! Form::label('reenter Password', 'Re-enter Password') !!}
                            {!! Form::input('password','password_confirmation',null, array('class' => 'form-control', 'placeholder' => 'Enter Re-enter Password','maxlength'=>15)) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="error">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                @endif
                     <div class="form-group">
                        {!! Form::label('photo', 'Photo') !!}
                        <div class="flexbox">
                            <div class="flexbox-b flexwrap justify-content-center">
                                <div class="upload-profile">
                                    <img class="file-upload img-circle profile-img" src="{{(isset($user) ? $user->photo : \Helper::getProfileImg(''))}}" alt="User Photo" width="90" height="90">
                                </div>
                            </div>
                            <div class="input-group pl-5">
                                {!! Form::file('photo',null, array('class' => 'form-control text-center', 'placeholder' => 'Photo')) !!}
                                @if ($errors->has('photo'))
                                    <small class="error">{{ $errors->first('photo') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
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
                </div>
                <div class="ibox-footer">
                    {!! Form::submit('Save', array('class' => 'btn btn-info mr-2','id'=>"submitbtn")) !!}
                    <a href="{{route('admin.customers.edit',$customer_id)}}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    @if(isset($user))
        <div class="col-md-4" id="changepass">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Update Password</div>
                </div>
                <div id="notify"></div>
                {!! Form::open(array('route' => ['admin.user.changepass', $user->user_id], 'method'=>'POST', 'id' => 'reset-password-form', 'name' => 'reset-password-form','autocomplete' => 'off')) !!}
                <div class="ibox-body">
                    <input type="hidden" name="user_id" value="{{isset($user) ? $user->user_id : null}}">
                    <div class="form-group mb-4">
                        {!! Form::label('oldpassword', 'Old Password') !!}
                        <div class="input-group">
                            {!! Form::input('password','oldpassword',null, array('class' => 'form-control', 'placeholder' => 'Enter Old Password')) !!}                                    
                        </div>    
                        @if ($errors->has('oldpassword'))
                            <small class="error">{{ $errors->first('oldpassword') }}</small>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('newpassword', 'New Password') !!}
                        {!! Form::input('password','password',null, array('class' => 'form-control', 'placeholder' => 'Enter New Password','maxlength'=>15)) !!}
                        @if ($errors->has('password'))
                            <small class="error">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('reenter Password', 'Re-enter Password') !!}
                        {!! Form::input('password','password_confirmation',null, array('class' => 'form-control', 'placeholder' => 'Enter Re-enter Password','maxlength'=>15)) !!}
                        @if ($errors->has('password_confirmation'))
                            <span class="error">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-info" type="submit" id="resetsubmit">Change Password</button>
                </div>
                {!! Form::close() !!}
            </div>  
        </div>
    @endif    
    </div>
</div>
@endsection

@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
@endsection

@section('page-scripts')
    {!! Html::script('/assets/admin/js/customers/createuser.min.js') !!}
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
