@extends('web.layouts.app')

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection
@section('page-css')
    {{ Html::style('/assets/web/css/user.css') }}
@endsection

@section('pagetitle',$pagetitle)

@section('pagecontent')
    <!-- Page Heading Breadcrumbs -->
	@include('web.layouts.breadcrumbs')
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
	                                <div class="user-profile">
	                                	
	                                    <img class="img-circle profile-img" src="{{$auth_user->photo}}" alt="image" width="110" height="110">
	                                </div>
	                                <div>
	                                    <h4>{{$auth_user->fullname}}</h4>
	                                    <div class="mb-1" style="color: #747474">
	                                        <span class="mr-1">{{$auth_user->email}}</span>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
						</div>
						
						@if(isset($user))
							{!! Form::model($user, ['method' => 'PATCH', 'files'=>true, 'route' => ['user.profile.update', $user->user_id],'id' => 'user-form']) !!}
						@else
							{!! Form::open(array('route' => 'user.profile.store', 'id' => 'item-form')) !!}
						@endif
						<div class="ibox-body">
                            <div class="form-group mb-4 row">
                                {!! Form::label('email', 'Email',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                	<div class="input-group">
                                		<span class="input-group-addon"><i class="ti-email"></i></span>
                                		{!! Form::text('email',null, array('class' => 'form-control', 'placeholder' => 'Email')) !!}		
                                	</div>
                                	@if ($errors->has('email'))
	                                    <small class="error">{{ $errors->first('email') }}</small>
	                                @endif  
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	{!! Form::label('username', 'Username',array('class' => 'col-sm-3 col-form-label')) !!}
                                <div class="col-sm-9">
                                	<div class="input-group">
                                		<span class="input-group-addon"><i class="fa fa-user"></i></span>
								    	{!! Form::text('username',null, array('class' => 'form-control', 'placeholder' => 'User Name','readonly'=>true)) !!}	
                                	</div>
                                </div>
                            </div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info mr-2" type="submit" id="profilesubmitbtn">Submit</button>
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
					{!! Form::open(array('route' => ['user.changepassword', $user->user_id], 'method'=>'POST', 'id' => 'reset-password-form', 'name' => 'reset-password-form','autocomplete' => 'off')) !!}
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
	</div>
</div>
@endsection
@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
@endsection

@section('page-scripts')
    {!! Html::script('/assets/web/js/user/edit.min.js') !!}
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
