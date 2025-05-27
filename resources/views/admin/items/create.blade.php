@extends('admin.layouts.app')

@section('pagetitle',$pagetitle)

@section('pagecontent')
    <!-- Page Heading Breadcrumbs -->
	@include('admin.layouts.breadcrumbs')
    <div class="page-content fade-in-up">
        <div class="ibox ibox-fullheight">
            @if(isset($item))
                {!! Form::model($item, ['method' => 'PATCH', 'route' => ['admin.items.update', $item->item_id], 'id' => 'item-form']) !!}
            @else
                {!! Form::open(array('route' => 'admin.items.store', 'id' => 'item-form')) !!}
            @endif
                <div class="ibox-body">
					<div id="notify"></div>
                    <div class="form-group mb-4{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Item Name') !!}
                        {!! Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Item Name')) !!}
					@if ($errors->has('name'))
	                    <small class="error">{{ $errors->first('name') }}</small>
		            @endif
                    </div>
                    <div class="form-group mb-4">
                        {!! Form::label('description', 'Description') !!}
						{!! Form::textarea('description', null ,  ['class' => 'form-control','rows'=>'5','placeholder'=>"Item Description"]) !!}
                    </div>
                    <div class="form-group mb-0{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>Enable</label>
                        <div>
                            <label class="radio radio-inline radio-info">
                                {!! Form::radio('isactive', 1, true) !!}
                                <span class="input-span"></span>Yes
                            </label>
                            <label class="radio radio-inline radio-info">
                                {!! Form::radio('isactive', 0, false) !!}
                                <span class="input-span"></span>No
                            </label>
                        </div>
					@if ($errors->has('isactive'))
		                <small class="error">
                            {{ $errors->first('isactive') }}
		                </small>
		            @endif
                    </div>
                </div>
                <div class="ibox-footer">
                    <button class="btn btn-info mr-2" type="submit">Submit</button>
					<a href="{{ route('admin.items.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('page-scripts')
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
