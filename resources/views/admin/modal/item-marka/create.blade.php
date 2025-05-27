@extends('admin.layouts.modal')

@section('modaltitle')
    {{ $modaltitle }}
@endsection

@section('modelcontent')
{{ Form::open(['route' => 'admin.item-marka.savemodal','method' => 'POST', 'id' => 'add_marka_form']) }}
    <div class="modal-body">
        <div id="modalnotify"></div>
        <div class="example-grid">
            <div class="form-group mb-4 {{ $errors->has('item_id') ? ' has-error' : '' }}">
                {!! Form::label('item_id', 'Item') !!}
                {!! Form::select('item_id', (array(""=>"Select Item") + $items), null , ['class' => 'form-control','required'=>true]) !!}
                @if ($errors->has('item_id'))
                    <small class="error">{{ $errors->first('item_id') }}</small>
                @endif
            </div>
            <div class="form-group mb-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'Marka Name') !!}
                {!! Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Marka Name','required'=>true)) !!}
                @if ($errors->has('name'))
                    <small class="error">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group mb-4">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null ,  ['class' => 'form-control','rows'=>'5','placeholder'=>"Marka Description"]) !!}
            </div>            
        </div>    
    </div>
    <div class="modal-footer">
        {!! Form::submit('Submit', array('class' => 'btn btn-primary','id'=>"submitbtn")) !!}
        <a class="btn btn-secondary" data-dismiss="modal">Cancel</a >
    </div>
    {{ Form::close() }}
    {!! Html::script('/assets/app/js/plugin/jquery.form.min.js') !!}
    {!! Html::script('/assets/admin/js/modal/item-marka/create.js') !!}
@endsection
