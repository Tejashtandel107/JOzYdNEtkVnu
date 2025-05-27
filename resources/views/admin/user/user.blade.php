@extends('admin.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection
@section('page-css')
    {{ Html::style('/assets/admin/css/user.css') }}
@endsection

@section('pagetitle',$pagetitle)

@section('pagecontent')
    <!-- Page Heading Breadcrumbs -->
	@include('admin.layouts.breadcrumbs')
	<?php
	    $application_name=config('app.name');
	    $auth_user = (Auth::check()) ? Auth::user () : null;
	    $user_role_lables = config('constant.USER_ROLE_LABELS');
	?>
    <div class="page-content fade-in-up">
		<div class="content">
			<div class="row">
				<div class="col-md-8" id="profile-info">
					<div class="ibox">
						<div class="ibox-head">
							<div class="ibox-title">Profile Information</div>
						</div>
						<div id="notify"></div>
						<div class="ibox-body">
							<div class="flexbox">
	                            <div class="flexbox-b flexwrap justify-content-center">
	                                <div class="user-profile upload-profile">
	                                    <img class="img-circle profile-img" src="{{$auth_user->photo}}" alt="image" width="90" height="90">
	                                </div>
	                                <div>
	                                    <h4>{{$auth_user->fullname}}</h4>
	                                    <div class="mb-1" style="color: #747474">
	                                        <span class="mr-1">{{$auth_user->email}}</span>
	                                    </div>
	                                    <div class="mb-3" style="color: #747474">
	                                        <span class="badge badge-blue">{{$user_role_lables[$auth_user->role_id]['display_name'] }}</span>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
						</div>
					@if(isset($user))
						{!! Form::model($user, ['method' => 'PATCH', 'files'=>true, 'route' => ['admin.profile.update', $user->user_id],'id' => 'user-form']) !!}
					@else
						{!! Form::open(array('route' => 'admin.profile.store', 'id' => 'item-form')) !!}
					@endif
						<div class="ibox-body">
							<div class="form-group mb-4 row">
                                {!! Form::label('firstname', 'First Name',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                	{!! Form::text('firstname',null, array('class' => 'form-control', 'placeholder' => 'First Name')) !!}
	                            	@if ($errors->has('firstname'))
									    <small class="error">{{ $errors->first('firstname') }}</small>
									@endif
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                {!! Form::label('lastname', 'Last Name',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                	{!! Form::text('lastname',null, array('class' => 'form-control', 'placeholder' => 'Last Name')) !!}									    
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                {!! Form::label('email', 'Email',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                	{!! Form::text('email',null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}

		                            @if ($errors->has('email'))
		                                    <small class="error">{{ $errors->first('email') }}</small>
		                            @endif
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('username', 'Username',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="input-group col-sm-9">
                                	<span class="input-group-addon"><i class="fa fa-user"></i></span>
								    {!! Form::text('username',null, array('class' => 'form-control', 'placeholder' => 'User Name','readonly'=>true)) !!}
                                </div>
                            @if ($errors->has('username'))
                                <small class="error">{{ $errors->first('username') }}</small>
                            @endif
                            </div>
                            <div class="form-group row">
                            	{!! Form::label('photo', 'Photo',array('class' => 'col-sm-3 col-form-label')) !!}
								<div class="input-group col-sm-9">
									{!! Form::file('photo',null, array('class' => 'form-control text-center', 'placeholder' => 'Photo','required'=>true)) !!}
                                    @if ($errors->has('photo'))
                                        <small class="error">{{ $errors->first('photo') }}</small>
                                    @endif
								</div>
							</div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info mr-2" type="submit" id="profileBtn">Submit</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
				<div class="col-md-4" id="reset-password">
					<div class="ibox">
						<div class="ibox-head">
							<div class="ibox-title">Update Password</div>
						</div>
						<div id="notify"></div>
						{!! Form::open(array('route' => ['admin.user.changepassword', $user->user_id], 'method'=>'POST', 'id' => 'reset-password-form', 'name' => 'reset-password-form','autocomplete' => 'off')) !!}
						<div class="ibox-body">
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
							<button class="btn btn-info" type="submit" id="submitbtn">Change Password</button>
						</div>
					    {!! Form::close() !!}
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-8" id="company-info">
					<div class="ibox">
						<div id="notify"></div>
						
						@if(isset($company))
							{!! Form::model($company, ['method' => 'PATCH', 'files'=>true, 'route' => ['admin.updatecompanyinfo', $company->id],'id' => 'company-form']) !!}
						@else
							{!! Form::open(array('route' => 'admin.storecompanyinfo', 'id' => 'company-form')) !!}
						@endif
					@php
						if(isset($company) && $company->count()>0){
							$company = json_decode($company->value);
						}
					@endphp
						<div class="ibox-head">
							<div class="ibox-title">Company Information</div>
						</div>
						<div class="ibox-body">
							<div class="form-group mb-4 row">
                            	{!! Form::label('companyname', 'Company Name',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('companyname',(isset($company->companyname) ? $company->companyname : null), array('class' => 'form-control', 'placeholder' => 'Company Name')) !!}
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('gstnumber', 'GST Number',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('gstnumber',(isset($company->gstnumber) ? $company->gstnumber : null), array('class' => 'form-control', 'placeholder' => 'GST Number')) !!}
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('address', 'Address',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
								    {!! Form::textarea('address',(isset($company->address) ? $company->address : null), array('class' => 'form-control', 'placeholder' => 'Address','rows'=>'4')) !!}
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('phone', 'Phone',array('class' => 'col-sm-3 col-form-label')) !!}
                            	<div class="col-sm-9">
                            		<div class="input-group">
	                            		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
	                                	{!! Form::text('phone',(isset($company->phone) ? $company->phone : null), array('class' => 'form-control', 'placeholder' => 'Phone','maxlength'=>15)) !!}
	                                </div>
                            	</div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('gods_quotes', 'Gods Quotes',array('class' => 'col-sm-3 col-form-label')) !!}
                            	<div class="col-sm-9">
                                	{!! Form::text('gods_quotes',(isset($company->gods_quotes) ? $company->gods_quotes : null), array('class' => 'form-control', 'placeholder' => 'Gods Quotes')) !!}
                            	</div>
                            </div>
                            <div class="form-group row">
                            	{!! Form::label('logo', 'Logo',array('class' => 'col-sm-3 col-form-label')) !!}
                            	<div class="flexbox col-sm-9">
		                            <div class="flexbox-b flexwrap justify-content-center">
		                                <div class="upload-profile">
		                                    <img class="file-upload img-circle profile-img company-img" src="{{(isset($company->logo) ? \Helper::getProfileImg($company->logo) : \Helper::getProfileImg(''))}}" alt="Company Logo" width="90" height="90">
		                                </div>
		                            </div>
		                            <div class="input-group pl-5">
										{!! Form::file('logo',null, array('class' => 'form-control text-center', 'placeholder' => 'logo')) !!}
	                                    @if ($errors->has('logo'))
	                                        <small class="error">{{ $errors->first('logo') }}</small>
	                                    @endif
									</div>
		                        </div>
								
							</div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info mr-2" type="submit" id="submitDetails">Submit</button>
						</div>
						{!! Form::close() !!}
					</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
@endsection

@section('page-scripts')
    {!! Html::script('/assets/admin/js/user/edit.min.js') !!}
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
