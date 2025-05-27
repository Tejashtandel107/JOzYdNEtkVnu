@extends('admin.layouts.modal')

@section('modaltitle')
    {{ $modaltitle }}
@endsection

@section('modelcontent')
{{ Form::open(['route' => 'admin.items.savemodal','method' => 'POST', 'id' => 'add_item_form']) }}
    <div class="modal-body">
        <div id="modalnotify"></div>
        <div class="example-grid">
            <div class="form-group mb-4{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Item Name') !!}
                {!! Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Item Name','required'=>true)) !!}
                @if ($errors->has('name'))
                    <small class="error">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group mb-4">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null ,  ['class' => 'form-control','rows'=>'5','placeholder'=>"Item Description"]) !!}
            </div>
            <div class="form-group mb-0{{ $errors->has('isactive') ? ' has-error' : '' }}">
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
                    <small class="error">{{ $errors->first('isactive') }}</small>
                @endif
            </div>
        </div>    
    </div>
    <div class="modal-footer">
        {!! Form::submit('Submit', array('class' => 'btn btn-primary','id'=>"submitbtn")) !!}
        <a class="btn btn-secondary" data-dismiss="modal">Cancel</a >
    </div>
    {{ Form::close() }}
    {!! Html::script('/assets/app/js/plugin/jquery.form.min.js') !!}
    {!! Html::script('/assets/admin/js/modal/items/create.js') !!}
@endsection
