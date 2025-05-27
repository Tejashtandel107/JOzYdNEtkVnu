@extends('admin.layouts.app')

@section('pagetitle',$pagetitle)
@section('plugin-css')
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection

@section('pagecontent')
    <!-- Page Heading Breadcrumbs -->
	@include('admin.layouts.breadcrumbs')
    <div class="page-content fade-in-up">
        <div class="ibox ibox-fullheight">
            @if(isset($marka))
                {!! Form::model($marka, ['method' => 'PATCH', 'route' => ['admin.item-marka.update', $marka->marka_id], 'id' => 'marka-form']) !!}
            @else
                {!! Form::open(array('route' => 'admin.item-marka.store', 'id' => 'marka-form')) !!}
            @endif
                <div class="ibox-body">
					<div id="notify"></div>
					<div class="form-group">
                        {!! Form::label('item_id', 'Item') !!}
						{!! Form::select('item_id', (array(""=>"Select Item") + $items), null , ['class' => 'form-control', 'id'=>'item_id']) !!}
						@if ($errors->has('item_id'))
			                <small class="error">{{ $errors->first('item_id') }}</small>
			            @endif
                    </div>
                    <div class="form-group mb-4{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Marka name')) !!}
    					@if ($errors->has('name'))
    		                <small class="error">{{ $errors->first('name') }}</small>
    		            @endif
                    </div>					
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-info mr-2" type="submit" id="submitbtn">Submit</button>
					<a href="{{ route('admin.item-marka.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('plugin-scripts')
	{!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
@endsection

@section('page-scripts')
    <!-- {!! Html::script('/assets/admin/js/item-marka/create.js') !!}	 -->
@endsection
