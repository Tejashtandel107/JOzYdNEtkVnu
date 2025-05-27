<!-- Template to load json data -->
@php
    use Carbon\Carbon;

    $order_date = ($outward_order_date) ?  Carbon::createFromFormat(config('constant.DATE_FORMAT_SHORT'),$outward_order_date)->startOfDay() : Carbon::now();

    $adjust_date = $order_date->copy()->firstOfMonth();
    $adjust_date = $adjust_date->addDays(14);
    
    if($adjust_date->greaterThanOrEqualTo($order_date)){
        $final_date = $adjust_date;
    }
    else{
        $final_date = $order_date->copy()->lastOfMonth();
        //$final_date = new Carbon('last day of this month');
    }
@endphp
@foreach($order_items as $order_item)
    @php
        if(isset($item_marka) && $item_marka->isNotEmpty()) {
            $markas = $item_marka->get($order_item->item_id)->pluck('name','marka_id');                            
        }
        $markas->prepend("Select","");
    
        $date = Carbon::createFromFormat(config('constant.DATE_FORMAT_SHORT'),$order_item->date)->startOfDay();
        
        $days_diff = $date->diffInDays($final_date->addDays(1),false);
    @endphp
<div class="display-group">
    <div class="row align-items-end"> 
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2"> 
            <label>Vakkal Number</label>
            {!! Form::text('vakkal_number[]', isset($order_item->vakkal_number) ? $order_item->vakkal_number : null , array('class' => 'form-control','placeholder' => 'xxxx/xxx/xx','required'=>true)) !!}                        
        </div>
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
            <label>Item</label>
            {!! Form::select('item_id[]', (array(""=>"Select") + $items), $order_item->item_id, ['class' => 'form-control','id'=>'item_id','onchange'=>'fetchMarka(this)','required'=>true]) !!}
        </div>
        <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2"> 
            <label>Marka</label>
            {!! Form::select('marka_id[]', $markas, $order_item->marka_id, ['class' => 'form-control','id'=>'marka_id','required'=>true]) !!}
        </div>
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2">
            <label>Details</label>
            {!! Form::text('details[]', $order_item->getRawOriginal('description'), array('class' => 'form-control','placeholder' => 'Details','maxlength'=>45)) !!}
        </div>
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
            <label>Bag Weight (in kg)</label>
            {!! Form::text('weight[]', $order_item->weight, array('class' => 'form-control','placeholder' => 'Bag Weight (in kg)','required'=>true)) !!}
        </div>
        <div class="col-12 col-md-2 pl-sm-1 col-sm-4 pb-2"> 
            <label>Quantity</label>   
            {!! Form::text('quantity[]',$order_item->quantity, array('class' => 'form-control','placeholder' => 'Quantity','required'=>true)) !!}
        </div>
    </div>
    <div class="row align-items-end">
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pb-2"> 
            <label>Chamber</label>                              
            {!! Form::select('chamber_id[]', (array(""=>"Select") + $chambers), $order_item->chamber_id, ['class' => 'form-control','required'=>true]) !!}
        </div>    
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">                          
            <label>Floor</label>
            {!! Form::select('floor_id[]', (array(""=>"Select") + $floors), $order_item->floor_id, ['class' => 'form-control','required'=>true]) !!}
        </div>  
        <div class="col-12 col-md-2 col-sm-4 pr-md-1 pl-sm-1 pb-2">                             
            <label>Grid</label>
            {!! Form::select('grid_id[]', (array(""=>"Select") + $grids), $order_item->grid_id, ['class' => 'form-control','required'=>true]) !!}
        </div>   
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-md-1 pb-2">
            <label>No. of Days</label>
            {!! Form::text('no_of_days[]', $days_diff , array('class' => 'form-control','placeholder'=>'Number of Days','required'=>true)) !!}
        </div>
        <div class="col-12 col-md-2 col-sm-4 pr-sm-1 pl-sm-1 pb-2">
            <label>Cooling Charge Rate (per month/kg)</label>
            {!! Form::text('rate[]', $order_item->rate, array('class' => 'form-control','placeholder' => 'Cooling Charge Rate (per month/kg)','required'=>true)) !!}
        </div>
        <div class="col-12 col-md pl-sm-1 col-sm-4 pb-2">  
            <label>Taxable</label> 
            {!! Form::select('is_taxable[]',['' => 'Select','1' => 'Yes', '0' => 'No'], $order_item->is_taxable, ['class' => 'form-control', 'id'=>"is_taxable",'required'=>true]) !!}
        </div>  
        <a class="remove-item text-danger custom-class" href="javascript:void(0)" onclick="removeItem(this);"><i class="fas fa-times-circle"></i></a>
    </div>    
    <div class="mb-2 d-sm-none">
        <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(this)"><i class="fa fa-minus"></i></button>
    </div> 
</div> 
@endforeach