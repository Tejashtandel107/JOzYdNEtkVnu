@extends('admin.layouts.app')

@section('pagetitle',$pagetitle)

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
    {{ Html::style('/assets/app/vendors/formvalidation/formValidation.min.css') }}
@endsection

@section('page-css')
    {{ Html::style('/assets/admin/css/inwards/create.css') }}    
    {{ Html::style('/assets/admin/css/outwards/type-ahead.css') }}    
@endsection

@section('pagecontent')
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
@if(isset($customer_order))
    {{ Form::model($customer_order ,['method'=>'PATCH' , 'route' => ['admin.outwards.update', $customer_order->customer_order_id],'id'=>"customerorders-form",'onsubmit'=>'return OnFormSubmit(this,true)']) }}
@else 
    {!! Form::open(array('route' => 'admin.outwards.store', 'id' => 'customerorders-form','onsubmit'=>'return OnFormSubmit(this,false)')) !!}
@endif    
    <div class="ibox ibox-fullheight">
        <div class="ibox-body">
            <input type="hidden" name="printoutward" value="1" id="printoutward">
            <div id="notify"></div>                
            <div class="alert alert-primary alert-bordered"><h5>Outward Info</h5></div>   
            <div class="row">
                <div class="form-group col-lg-4 col-md-6 col-12">                            
                    {!! Form::label('customer_id', 'Customer') !!}
                    {!! Form::select('customer_id', (array(""=>"Select") + $customers->pluck('fullname','customer_id')->toArray()), null , ['class' => 'form-control customer_id','id'=>'customer_id',"onChange"=>'ChangeAddress(this)','required'=>true]) !!}
                    @if ($errors->has('customer_id'))
                        <small class="error">{{ $errors->first('customer_id') }}</small>
                    @endif
                </div>    
                <div class="form-group col-lg-4 col-md-6 col-sm-12">
                    {!! Form::label('date', 'Outward Date') !!}
                    <div class="input-group mb-2 date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        {!! Form::text('date',isset($customer_order) ? $customer_order->date : Helper::DateFormat(today(),config('constant.DATE_FORMAT_SHORT')) , array('class' => 'form-control datepicker', 'id' => 'order-date','placeholder' => 'DD/MM/YYYY','required'=>true)) !!}                        
                    </div>    
                    @if ($errors->has('date'))
                        <small class="error">{{ $errors->first('date') }}</small>
                    @endif
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12">                            
                    {!! Form::label('sr_no', 'Serial Number') !!}
                    <div class="input-group mb-2 date">
                        <span class="input-group-addon"><i class="ti ti-receipt"></i></span>
                        {!! Form::number('sr_no', ($serial_no) ?? null , array('class' => 'form-control', 'placeholder' => 'Serial Number','required'=>true)) !!}
                    </div>                                                                                                                                      
                </div>                                                                                                                                                                                              
            </div>                 
            <div class="row">      
                <div class="form-group col-lg-4 col-md-6 col-sm-12">                            
                    {!! Form::label('address', 'Delivery Address') !!}
                    {!! Form::textarea('address', null , array('class' => 'form-control address', 'placeholder' => 'Delivery Address','rows'=>2)) !!}
                </div>                                                                                                                                  
                <div class="form-group col-lg-4 col-md-6 col-sm-12">                            
                    {!! Form::label('order_by', 'Order By') !!}
                    {!! Form::text('order_by', null , array('class' => 'form-control', 'placeholder'=> 'Order By')) !!}
                </div>                                                                                                                    
                <div class="form-group col-lg-4 col-md-6 col-sm-12">                            
                    {!! Form::label('vehicle', 'Vehicle Number') !!}
                    <div class="input-group mb-2 date">
                        <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                        {!! Form::text('vehicle', null , array('class' => 'form-control', 'placeholder' => 'Vehicle Number')) !!}
                    </div>                                                                                                                                      
                </div>                                                                                                                                              
            </div>            
            <br/><br/>
            <div class="alert alert-primary alert-bordered"><h5>Search Inward</h5></div>            
            <div class="row">                                  
                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">                    
                    <div class="d-flex align-items-center flexwrap">
                        <div class="mr-2 mb-2 flex-grow">
                            <label class="pr-1">Date Range:</label>
                            <div class="input-group date">
                                {!! Form::text('from', isset($from) ? Helper::DateFormat($from,config('constant.DATE_FORMAT_SHORT')) : null , array('id'=>'from','class' => 'from form-control datepicker','placeholder' => 'From')) !!}
                                <span class="input-group-addon pl-2 pr-2">to</span>
                                {!! Form::text('to', isset($to) ? Helper::DateFormat($to,config('constant.DATE_FORMAT_SHORT')) : null , array('id'=>'to','class' => 'to form-control datepicker','placeholder' => 'To')) !!}
                            </div>        
                        </div>
                        <div class="mr-2 mb-2 flex-grow">
                            <label class="pr-1">Item:</label>
                            {!! Form::select('item', (array(""=>"Select") + $items), null , ['id'=>'item','class' => 'item form-control','onchange'=>'fetchMarka(this)']) !!}
                        </div>
                        <div class="mr-2 mb-2 flex-grow">
                            <label class="pr-1">Marka:</label>
                            {!! Form::select('marka', array(""=>"Select"), null , ['id'=>'marka_id','class' => 'marka form-control']) !!}
                        </div>
                        <div class="mr-2 mb-2 flex-grow">
                            <label class="pr-1">Search</label>
                            <div class="input-group-icon input-group-icon-left">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                {!! Form::text('search',null, array('id'=>'search','class' => 'search form-control','placeholder' => 'Vakkal Number')) !!}
                            </div>
                        </div>  
                        <div class="mb-2 align-self-end">
                            <a class="btn btn-primary" href="javascript:void(0)" onclick="ajaxsearchfilter()">Filter</a>                                                                                  
                        </div>
                    </div>                                              
                </div>    
            </div>  
            <div class="addlist"></div>          
            <br/><br/>
            <!-- <div class="row mb-5">
                <div class="col-lg-6 col-md-8 col-sm-12 mb-2">                        
                    {!! Form::text('vakkal_number',null, array('class' => 'form-control', 'placeholder' => 'Search Vakkal Number','id'=>"livesearchvakkalnumber")) !!}                                            
                </div>  
                <div class="col-lg-6 col-md-4 col-sm-12">
                    <button type="button" class="btn btn-primary" onclick="getInwardData()">Add</button>
                </div>
            </div>  -->

            <div class="alert alert-primary alert-bordered"><h5>Outward Item Entries</h5></div>            
            <div id="adddivision">                       
            @if(isset($order_items) && $order_items->count()>0)
                @foreach($order_items as $order_item)
                    @php
                        if(isset($item_marka) && $item_marka->isNotEmpty()) {
                            $markas = $item_marka->get($order_item->item_id)->pluck('name','marka_id');                            
                        }
                        $markas->prepend("Select","");
                    @endphp
                <div class="display-group">
                    <div class="row align-items-end">    
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2"> 
                            <label>Vakkal Number</label>
                            {!! Form::text('vakkal_number[]',$order_item->vakkal_number, array('class' => 'form-control', 'placeholder' => 'xxxx/xxx/xx','required'=>true)) !!}
                        </div>
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
                            <label>Item</label>
                            {!! Form::select('item_id[]', (array(""=>"Select") + $items), $order_item->item_id , ['class' => 'form-control', 'id'=>"item_id",'required'=>true,'onchange'=>'fetchMarka(this)']) !!}
                        </div>
                        <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2"> 
                            <label>Marka</label>                              
                            {!! Form::select('marka_id[]', $markas, $order_item->marka_id , ['class' => 'form-control', 'id'=>"marka_id",'required'=>true]) !!}
                        </div>
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2">
                            <label>Details</label>                               
                            {!! Form::text('details[]',$order_item->getRawOriginal('description'), array('class' => 'form-control', 'id'=>'details' ,'placeholder' => 'Details','maxlength'=>45)) !!}                                        
                        </div>
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">    
                            <label>Bag Weight (in kg)</label>
                            {!! Form::text('weight[]',$order_item->weight, array('class' => 'form-control', 'placeholder' => 'Bag Weight (in kg)','id'=>"weight",'required'=>true,'step'=>'any','min'=>'0')) !!}                                
                        </div>
                        <div class="col-12 col-md-2 pl-sm-1 col-sm-4 pb-2"> 
                            <label>Quantity</label>                           
                            {!! Form::text('quantity[]',$order_item->quantity, array('class' => 'form-control', 'id'=>'quantity' ,'placeholder' => 'Quantity','required'=>true,'min'=>'0')) !!}  
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2">  
                            <label>Chamber</label>                            
                            {!! Form::select('chamber_id[]', (array(""=>"Select") + $chambers), $order_item->chamber_id , ['class' => 'form-control', 'id'=>"chamber_id",'required'=>true]) !!}
                        </div>    
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2"> 
                            <label>Floor</label>                             
                            {!! Form::select('floor_id[]', (array(""=>"Select") + $floors), $order_item->floor_id , ['class' => 'form-control', 'id'=>"floor_id",'required'=>true]) !!}
                        </div> 
                        <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2"> 
                            <label>Grid</label>                               
                            {!! Form::select('grid_id[]', (array(""=>"Select") + $grids), $order_item->grid_id , ['class' => 'form-control', 'id'=>"grid_id",'required'=>true]) !!}
                        </div>    
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2">
                            <label>No. of Days</label>
                            {!! Form::text('no_of_days[]', $order_item->no_of_days , array('class' => 'form-control', 'id'=>'no_of_days' ,'placeholder' => 'Number of Days','required'=>true)) !!}
                        </div>
                        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
                            <label>Cooling Charge Rate (per month/kg)</label>
                            {!! Form::text('rate[]', $order_item->rate , array('class' => 'form-control', 'id'=>'rate' ,'placeholder' => 'Cooling Charge Rate (per month/kg)','required'=>true)) !!}
                        </div>
                        <div class="col-12 col-md pl-sm-1 col-sm-4 pb-2"> 
                            <label>Taxable</label> 
                            {!! Form::select('is_taxable[]',['' => 'Select','1' => 'Yes', '0' => 'No'], $order_item->is_taxable, ['class' => 'form-control', 'id'=>"is_taxable",'required'=>true]) !!}
                        </div> 
                        <a class="remove-item text-danger custom-class" href="javascript:void(0)" onclick="removeItem(this);"><i class="fas fa-times-circle"></i></a>
                    </div>                                                   
                </div>                              
                @endforeach 
            @endif    
            </div>
            <!-- Hidden Template to add more -->
            <div class="display-group hide" id="ItemTemplate">
                <div class="row align-items-end"> 
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2"> 
                        <label>Vakkal Number</label>
                        {!! Form::text('vakkal_number[]',null, array('class' => 'form-control', 'placeholder' => 'xxxx/xxx/xx','id'=>"vakkal_number",'required'=>true,'disabled'=>'disabled')) !!}                        
                    </div>
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
                        <label>Item</label>
                        {!! Form::select('item_id[]', (array(""=>"Select") + $items), null , ['class' => 'form-control', 'id'=>'item_id','required'=>true,'disabled'=>'disabled','onchange'=>'fetchMarka(this)']) !!}
                    </div>
                    <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2"> 
                        <label>Marka</label>
                        {!! Form::select('marka_id[]', array(""=>"Select"), null , ['class' => 'form-control', 'id'=>"marka_id",'required'=>true,'disabled'=>'disabled']) !!}
                    </div>
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2"> 
                        <label>Details</label>
                        {!! Form::text('details[]', null , array('class' => 'form-control', 'id'=>'details' ,'placeholder' => 'Details','disabled'=>'disabled','maxlength'=>45)) !!}           
                    </div>
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
                        <label>Bag Weight (in kg)</label>
                        {!! Form::text('weight[]',null, array('class' => 'form-control', 'placeholder' => 'Bag Weight (in kg)','id'=>"weight",'disabled'=>'disabled','required'=>true,'step'=>'any','min'=>'0')) !!}   
                    </div>
                    <div class="col-12 col-md-2 pl-sm-1 col-sm-4 pb-2"> 
                        <label>Quantity</label>   
                        {!! Form::text('quantity[]',null, array('class' => 'form-control', 'placeholder' => 'Quantity','id'=>"quantity",'disabled'=>'disabled','required'=>true,'min'=>'0')) !!}
                    </div>    
                </div>
                <div class="row align-items-end">
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2"> 
                        <label>Chamber</label>                              
                        {!! Form::select('chamber_id[]', (array(""=>"Select") + $chambers), null , ['class' => 'form-control', 'id'=>"chamber_id",'disabled'=>'disabled','required'=>true]) !!}
                    </div>    
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">                           
                        <label>Floor</label>
                        {!! Form::select('floor_id[]', (array(""=>"Select") + $floors), null , ['class' => 'form-control', 'id'=>"floor_id",'disabled'=>'disabled','required'=>true]) !!}
                    </div>  
                    <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2">                            
                        <label>Grid</label>
                        {!! Form::select('grid_id[]', (array(""=>"Select") + $grids), null , ['class' => 'form-control', 'id'=>"grid_id",'disabled'=>'disabled','required'=>true]) !!}
                    </div> 
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2">
                        <label>No. of Days</label>
                        {!! Form::text('no_of_days[]', null , array('class' => 'form-control', 'id'=>'no_of_days' ,'placeholder' => 'Number of Days','disabled'=>'disabled','required'=>true)) !!}
                    </div>
                    <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
                        <label>Cooling Charge Rate (per month/kg)</label>
                        {!! Form::text('rate[]', null , array('class' => 'form-control', 'id'=>'rate' ,'placeholder' => 'Cooling Charge Rate (per month/kg)','disabled'=>'disabled','required'=>true)) !!}
                    </div>
                    <div class="col-12 col-md pl-sm-1 col-sm-4 pb-2">  
                        <label>Taxable</label>                               
                        {!! Form::select('is_taxable[]', ['' => 'Select', '1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control', 'id' => 'is_taxable', 'required' => true,'disabled'=>'disabled']) !!}
                    </div>
                    <a class="remove-item text-danger custom-class" href="javascript:void(0)" onclick="removeItem(this);"><i class="fas fa-times-circle"></i></a>
                </div>    
                <div class="mb-2 d-sm-none">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)"><i class="fa fa-minus"></i></button>
                </div> 
            </div> 
            <!-- Template to add more -->
            <div class="row">
                <div class="col-md-12">
                    <label class="m-t-5"><strong>Click (+Add) to add another entry</strong></label>                                    
                    <button type="button" class="btn btn-blue btn-sm" onclick="addItem()"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
            <br/><br/>  
            <div class="row">
                <div class="form-group col">                            
                    {!! Form::label('notes', 'Notes (Max 85 characters)') !!}
                    {!! Form::text('notes', null , array('class' => 'form-control', 'placeholder' => 'Notes','maxlength'=>90)) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-3 col-md-6 col-sm-12">                            
                    {!! Form::label('additional_charge', 'Additional Charge') !!}
                    <div class="input-group mb-2 date">
                        <span class="input-group-addon"><i class="fas fa-rupee-sign"></i></span>
                        {!! Form::number('additional_charge', null , array('class' => 'form-control', 'placeholder' => 'Additional Charge','step'=>'any','min'=>'0')) !!}
                    </div>                                                                                                                                      
                </div>
            </div>    
            <div class="ibox-footer row">                    
                <div class="col p-0">
                    <button type="submit" class="btn btn-info mr-2 mb-2" id="submitbtn">SAVE</button>
                    <a href="{{ route('admin.outwards.index')}}" class="btn btn-secondary mr-2 mb-2" data-dismiss="modal">CANCEL</a>
                @if(isset($customer_order))    
                    <a href="{{ route('admin.outwards.showReceipt',$customer_order->customer_order_id) }}" class="btn btn-blue mb-2">VIEW RECEIPT</a>
                @endif    
                </div>
            </div>                                                          
        </div>                    
    </div>
    {{ Form::close() }}
</div>    
@endsection

@section('plugin-scripts')
	{!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/formValidation.min.js') !!}
    {!! Html::script('/assets/app/vendors/formvalidation/framework/bootstrap4.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/0.11.1/typeahead.bundle.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/0.11.1/typeahead.jquery.min.js') !!}
@endsection

@section('page-scripts')
    {!! Html::script('/assets/admin/js/outwards/create.js') !!}

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

