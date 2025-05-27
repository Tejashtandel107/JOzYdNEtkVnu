@extends('admin.layouts.modal')

@section('modaltitle')
    {{ $modaltitle }}
@endsection

@section('modelcontent')
{{ Form::open(['route' => 'admin.customers.savemodal','method' => 'POST', 'id' => 'add_customer_form']) }}
    <div class="modal-body">
        <div id="modalnotify"></div>
        <div class="example-grid">
            <div class="form-group mb-4 {{ $errors->has('companyname') ? ' has-error' : '' }}">
                {!! Form::label('companyname', 'Company Name') !!}
                {!! Form::text('companyname',null, array('class' => 'form-control', 'placeholder' => 'Company Name','required'=>true)) !!}
                @if ($errors->has('companyname'))
                    <small class="error">{{ $errors->first('companyname') }}</small>
                @endif
            </div>            
            <div class="form-group mb-4">
                {!! Form::label('phone', 'Phone') !!}
                <div class="input-group mb-2 date">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    {!! Form::text('phone',null, array('class' => 'form-control', 'placeholder' => 'Phone','maxlength'=>15)) !!}                        
                </div>    
            </div>
            <div class="form-group mb-4">
                {!! Form::label('contact_person', 'Contact Person') !!}
                {!! Form::text('contact_person',null, array('class' => 'form-control', 'placeholder' => 'Contact Person','maxlength'=>255)) !!}                            
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
    {!! Html::script('/assets/admin/js/modal/customers/create.js') !!}
@endsection
