<?php $__env->startSection('plugin-css'); ?>
    <?php echo e(Html::style('/assets/app/vendors/formvalidation/formValidation.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-css'); ?>
    <?php echo e(Html::style('/assets/admin/css/user.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagetitle',$pagetitle); ?>

<?php $__env->startSection('pagecontent'); ?>
    <!-- Page Heading Breadcrumbs -->
	<?php echo $__env->make('admin.layouts.breadcrumbs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
	                                    <img class="img-circle profile-img" src="<?php echo e($auth_user->photo); ?>" alt="image" width="90" height="90">
	                                </div>
	                                <div>
	                                    <h4><?php echo e($auth_user->fullname); ?></h4>
	                                    <div class="mb-1" style="color: #747474">
	                                        <span class="mr-1"><?php echo e($auth_user->email); ?></span>
	                                    </div>
	                                    <div class="mb-3" style="color: #747474">
	                                        <span class="badge badge-blue"><?php echo e($user_role_lables[$auth_user->role_id]['display_name']); ?></span>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
						</div>
					<?php if(isset($user)): ?>
						<?php echo Form::model($user, ['method' => 'PATCH', 'files'=>true, 'route' => ['admin.profile.update', $user->user_id],'id' => 'user-form']); ?>

					<?php else: ?>
						<?php echo Form::open(array('route' => 'admin.profile.store', 'id' => 'item-form')); ?>

					<?php endif; ?>
						<div class="ibox-body">
							<div class="form-group mb-4 row">
                                <?php echo Form::label('firstname', 'First Name',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
                                	<?php echo Form::text('firstname',null, array('class' => 'form-control', 'placeholder' => 'First Name')); ?>

	                            	<?php if($errors->has('firstname')): ?>
									    <small class="error"><?php echo e($errors->first('firstname')); ?></small>
									<?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                <?php echo Form::label('lastname', 'Last Name',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
                                	<?php echo Form::text('lastname',null, array('class' => 'form-control', 'placeholder' => 'Last Name')); ?>									    
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                                <?php echo Form::label('email', 'Email',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
                                	<?php echo Form::text('email',null, array('class' => 'form-control', 'placeholder' => 'Email')); ?>


		                            <?php if($errors->has('email')): ?>
		                                    <small class="error"><?php echo e($errors->first('email')); ?></small>
		                            <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	<?php echo Form::label('username', 'Username',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="input-group col-sm-9">
                                	<span class="input-group-addon"><i class="fa fa-user"></i></span>
								    <?php echo Form::text('username',null, array('class' => 'form-control', 'placeholder' => 'User Name','readonly'=>true)); ?>

                                </div>
                            <?php if($errors->has('username')): ?>
                                <small class="error"><?php echo e($errors->first('username')); ?></small>
                            <?php endif; ?>
                            </div>
                            <div class="form-group row">
                            	<?php echo Form::label('photo', 'Photo',array('class' => 'col-sm-3 col-form-label')); ?>

								<div class="input-group col-sm-9">
									<?php echo Form::file('photo',null, array('class' => 'form-control text-center', 'placeholder' => 'Photo','required'=>true)); ?>

                                    <?php if($errors->has('photo')): ?>
                                        <small class="error"><?php echo e($errors->first('photo')); ?></small>
                                    <?php endif; ?>
								</div>
							</div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info mr-2" type="submit" id="profileBtn">Submit</button>
						</div>
						<?php echo Form::close(); ?>

					</div>
				</div>
				<div class="col-md-4" id="reset-password">
					<div class="ibox">
						<div class="ibox-head">
							<div class="ibox-title">Update Password</div>
						</div>
						<div id="notify"></div>
						<?php echo Form::open(array('route' => ['admin.user.changepassword', $user->user_id], 'method'=>'POST', 'id' => 'reset-password-form', 'name' => 'reset-password-form','autocomplete' => 'off')); ?>

						<div class="ibox-body">
							<div class="form-group mb-4">
								<?php echo Form::label('oldpassword', 'Old Password'); ?>

	                            <div class="input-group">
	                                <?php echo Form::input('password','oldpassword',null, array('class' => 'form-control', 'placeholder' => 'Enter Old Password')); ?>                                    
	                            </div>    
	                            <?php if($errors->has('oldpassword')): ?>
	                                <small class="error"><?php echo e($errors->first('oldpassword')); ?></small>
	                            <?php endif; ?>
							</div>
							<div class="form-group mb-4">
								<?php echo Form::label('newpassword', 'New Password'); ?>

								<?php echo Form::input('password','password',null, array('class' => 'form-control', 'placeholder' => 'Enter New Password','maxlength'=>15)); ?>

								<?php if($errors->has('password')): ?>
									<small class="error"><?php echo e($errors->first('password')); ?></small>
								<?php endif; ?>
							</div>
							<div class="form-group">
								<?php echo Form::label('reenter Password', 'Re-enter Password'); ?>

								<?php echo Form::input('password','password_confirmation',null, array('class' => 'form-control', 'placeholder' => 'Enter Re-enter Password','maxlength'=>15)); ?>

								<?php if($errors->has('password_confirmation')): ?>
									<span class="error"><?php echo e($errors->first('password_confirmation')); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info" type="submit" id="submitbtn">Change Password</button>
						</div>
					    <?php echo Form::close(); ?>

					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-md-8" id="company-info">
					<div class="ibox">
						<div id="notify"></div>
						
						<?php if(isset($company)): ?>
							<?php echo Form::model($company, ['method' => 'PATCH', 'files'=>true, 'route' => ['admin.updatecompanyinfo', $company->id],'id' => 'company-form']); ?>

						<?php else: ?>
							<?php echo Form::open(array('route' => 'admin.storecompanyinfo', 'id' => 'company-form')); ?>

						<?php endif; ?>
					<?php
						if(isset($company) && $company->count()>0){
							$company = json_decode($company->value);
						}
					?>
						<div class="ibox-head">
							<div class="ibox-title">Company Information</div>
						</div>
						<div class="ibox-body">
							<div class="form-group mb-4 row">
                            	<?php echo Form::label('companyname', 'Company Name',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
                                    <?php echo Form::text('companyname',(isset($company->companyname) ? $company->companyname : null), array('class' => 'form-control', 'placeholder' => 'Company Name')); ?>

                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	<?php echo Form::label('gstnumber', 'GST Number',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
                                    <?php echo Form::text('gstnumber',(isset($company->gstnumber) ? $company->gstnumber : null), array('class' => 'form-control', 'placeholder' => 'GST Number')); ?>

                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	<?php echo Form::label('address', 'Address',array('class' => 'col-sm-3 col-form-label')); ?>

                                <div class="col-sm-9">
								    <?php echo Form::textarea('address',(isset($company->address) ? $company->address : null), array('class' => 'form-control', 'placeholder' => 'Address','rows'=>'4')); ?>

                                </div>
                            </div>
                            <div class="form-group mb-4 row">
                            	<?php echo Form::label('phone', 'Phone',array('class' => 'col-sm-3 col-form-label')); ?>

                            	<div class="col-sm-9">
                            		<div class="input-group">
	                            		<span class="input-group-addon"><i class="fa fa-phone"></i></span>
	                                	<?php echo Form::text('phone',(isset($company->phone) ? $company->phone : null), array('class' => 'form-control', 'placeholder' => 'Phone','maxlength'=>15)); ?>

	                                </div>
                            	</div>
                            </div>
                            <div class="form-group mb-4 row">
                            	<?php echo Form::label('gods_quotes', 'Gods Quotes',array('class' => 'col-sm-3 col-form-label')); ?>

                            	<div class="col-sm-9">
                                	<?php echo Form::text('gods_quotes',(isset($company->gods_quotes) ? $company->gods_quotes : null), array('class' => 'form-control', 'placeholder' => 'Gods Quotes')); ?>

                            	</div>
                            </div>
                            <div class="form-group row">
                            	<?php echo Form::label('logo', 'Logo',array('class' => 'col-sm-3 col-form-label')); ?>

                            	<div class="flexbox col-sm-9">
		                            <div class="flexbox-b flexwrap justify-content-center">
		                                <div class="upload-profile">
		                                    <img class="file-upload img-circle profile-img company-img" src="<?php echo e((isset($company->logo) ? \Helper::getProfileImg($company->logo) : \Helper::getProfileImg(''))); ?>" alt="Company Logo" width="90" height="90">
		                                </div>
		                            </div>
		                            <div class="input-group pl-5">
										<?php echo Form::file('logo',null, array('class' => 'form-control text-center', 'placeholder' => 'logo')); ?>

	                                    <?php if($errors->has('logo')): ?>
	                                        <small class="error"><?php echo e($errors->first('logo')); ?></small>
	                                    <?php endif; ?>
									</div>
		                        </div>
								
							</div>
						</div>
						<div class="ibox-footer">
							<button class="btn btn-info mr-2" type="submit" id="submitDetails">Submit</button>
						</div>
						<?php echo Form::close(); ?>

					</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('plugin-scripts'); ?>
    <?php echo Html::script('/assets/app/vendors/formvalidation/formValidation.min.js'); ?>

    <?php echo Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <?php echo Html::script('/assets/admin/js/user/edit.min.js'); ?>

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/gurukrupafoodproducts/application/resources/views/admin/user/user.blade.php ENDPATH**/ ?>