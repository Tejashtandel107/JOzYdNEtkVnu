@extends('admin.layouts.app')

@section('pagetitle',$pagetitle)

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css') }}
@endsection

@section('page-css')
    {!! Html::style('/assets/admin/css/reports/fullledger-reports.css') !!}
@endsection

@section('pagecontent')
<!-- Page Heading Breadcrumbs -->
@include('admin.layouts.breadcrumbs')
<div class="page-content fade-in-up">
    <div class="ibox mb-2 noprint">
        <div class="ibox-body py-3">
        {{ Form::model($request,array('url' =>route('admin.reports.full-ledger.show'),'method'=>'get','id'=>'form-filter','autocomplete'=>'off')) }}
            <div id="notify"></div>
            <div class="row">                                  
                <div class="col-lg-12 col-md-12 col-sm-12 noprint">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-wrap">
                            <div class="mr-2 mb-2" style="width: 270px;">
                                <label class="pr-1">Date Range:</label>
                                <div class="input-group date">
                                    {!! Form::text('from', null , ['class' => 'form-control datepicker', 'placeholder' => 'From']) !!}
                                    <span class="input-group-addon pl-2 pr-2">to</span>
                                    {!! Form::text('to', null , array('class' => 'form-control datepicker','placeholder' => 'To')) !!}
                                </div>        
                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Customer:</label>
                               {!! Form::select('c', (array(""=>"Select","all_customer"=>"All Customers") + $customers->pluck('fullname','customer_id')->toArray()), null , ['class' => 'form-control']) !!}
                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Item:</label>
                                {!! Form::select('i', (array(""=>"Select") + $items->pluck('name','item_id')->toArray()), null , ['class' => 'form-control','onchange'=>'fetchMarka(this)']) !!}
                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Marka:</label>
                                {!! Form::select('m', (array(""=>"Select") + $markas->pluck('name','marka_id')->toArray()), null , ['class' => 'form-control','id'=>'marka_id']) !!}
                            </div>
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Search</label>
                                <div class="input-group-icon input-group-icon-left">
                                    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                    {!! Form::text('q',null, array('class' => 'form-control','placeholder' => 'Vakkal,Item,Marka,Quantity')) !!}
                                </div>
                            </div>      
                            <div class="mr-2 mb-2">
                                <label class="pr-1">Report Type :</label>
                                {!! Form::select('r', array(""=>"Select","fresh"=>"Fresh Stock","current"=>"Current Stock","finished"=>"Finished Stock"), null , ['class' => 'form-control']) !!}
                            </div>  
                            <div class="mb-2 align-self-end">
                                <input type="submit" class="btn btn-primary" href="javascript:void(0)" onclick="formsubmit()" value="Filter">  
                            </div>
                        </div>                          
                    </div>                  
                </div>    
            </div>            
        {{ Form::close() }}   
        </div>
    </div>   
    <div class="ibox" id="printbox">
        <div class="ibox-body text-right">                         
            <a class="btn btn-danger noprint" href="javascript:void(0)" onclick="exportReport('{{ route("admin.reports.full-ledger.export",$request->all()) }}');"><i class="fas fa-file-export"></i> Export</a> 
            <a class="btn btn-dark noprint" href="javascript:void(0)" onclick="printReport();"><i class="fa fa-print"></i> Print</a>
            <div>                         
            @if(isset($results) && ($results->count() > 0))
            @php            
                $full_ledgers = $results->groupBy('customer_id');
            @endphp                 
                @foreach($full_ledgers as $ledger_results)
            @php                
                $customer_info = $ledger_results->first();
            @endphp            
                <div class="main-wrapper {{($loop->first) ? '' : 'print-margin-top pagebreak'}}">
                    <div class="text-center">
                        <div class="text-center top-title ">|| {{$company_info->gods_quotes}} ||</div>
                        <div class="border border-black main-wrapper mb-2">
                            <div class="border-bottom d-flex justify-content-between align-items-center">
                                <div></div>
                                <div class="text-center font-20 font-weight-bold print-title">STOCKS REPORT</div>
                                <div class="pr-2"><small>Generated At : {{now()->format('d/m/Y g:i A')}}</small></div>
                            </div>
                            <table class="w-100">
                                <thead>
                                    <tr class="text-left">
                                        <td colspan="10" class="p-1 print-padding border-right w-70">
                                            <div>From : &nbsp;&nbsp;<span class="font-weight-bold">{{strtoupper($company_info->companyname)}}</span></div>
                                            <div>Address:&nbsp;&nbsp;<span class="font-weight-bold">{{$company_info->address}}</span></div>
                                            <div>GSTIN : &nbsp;&nbsp;<span class="font-weight-bold">{{$company_info->gstnumber}}</span></div>
                                            <div>Contact : &nbsp;&nbsp;<span class="font-weight-bold">{{$company_info->phone}}</span></div>
                                        </td>
                                        <td class="p-1 print-padding" colspan="2">
                                            <div class="pb-1 print-p-b-0">Report Type :
                                                <span class="font-weight-bold">
                                                    @php
                                                        $reportType = ($request['r']) ?? '';
                                                        switch ($reportType) {
                                                            case 'fresh':
                                                                $reportType='Fresh Stock';
                                                                break;
                                                            case 'current':
                                                                $reportType='Current Stock';
                                                                break;
                                                            case 'finished':
                                                                $reportType='Finished Stock';
                                                                break;
                                                            default:
                                                                $reportType='All';
                                                                break;
                                                        }
                                                    @endphp
                                                    {{ $reportType }}
                                                </span>
                                            </div>  
                                            <div class="pb-1 print-p-b-0">Stock Date Period :&nbsp;
                                                <span class="font-weight-bold">
                                                    {{ Helper::DateFormat($ledger_results->min('order_date'),'d/m/Y') }} to {{ Helper::DateFormat($ledger_results->max('order_date'),'d/m/Y') }}
                                                </span>                                    
                                            </div>
                                            <div class="pb-1 print-p-b-0">To : &nbsp;&nbsp;<span class="font-weight-bold">{{ $customer_info->fullname }}</span></div>
                                            <div class="pb-1 print-p-b-0">Address: &nbsp;&nbsp;<span class="font-weight-bold">{{$customer_info->address}}</span></div>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="w-100" border="1">
                                <thead>
                                    <tr>
                                        <td class="text-center font-weight-bold p-2 header-bg border-left">Date</td>
                                        <td class="text-center font-weight-bold header-bg">Type</td>
                                        <td class="text-center font-weight-bold header-bg">Sr.No.</td>
                                        <td class="text-center font-weight-bold header-bg">Item</td>
                                        <td class="text-center font-weight-bold header-bg">Marka</td>
                                        <td class="text-center font-weight-bold header-bg w-100px">Details</td>
                                        <td class="text-center font-weight-bold header-bg">Vakkal No.</td>
                                        <td class="text-center font-weight-bold header-bg">Location Code</td>
                                        <td class="text-center font-weight-bold header-bg">Weight</td>
                                        <td class="text-center font-weight-bold header-bg">Quantity</td>
                                        <td class="text-center font-weight-bold header-bg">Outstanding Quantity</td>
                                        <td class="text-center font-weight-bold header-bg">Outstanding Weight</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ledger_results as $result)
                                    <?php
                                        $receipt_link = "";
                                        $highlight_class='';
                                        $chamber = $chambers->get($result->chamber_id);
                                        $floor = $floors->get($result->floor_id);
                                        $grid = $grids->get($result->grid_id);
                                        
                                        if($result->isInward()){
                                            //Inward Case
                                            $receipt_link = route('admin.inwards.showReceipt',$result->customer_order_id);
                                        }
                                        if($result->isOutward()){
                                            //Outward Case
                                            $receipt_link = route('admin.outwards.showReceipt',$result->customer_order_id);
                                            $highlight_class='outward-highlight';
                                        }
                                    ?>
                                    <tr class="text-center {{ $highlight_class }}">
                                        <td class="border-left">{{ Helper::DateFormat($result->order_date,config('constant.DATE_FORMAT_SHORT')) }}</td>
                                        <td>{{ $result->type }}</td>
                                        <td><a href="{{$receipt_link}}" target="blank" class="text-success">{{ $result->sr_no }}</a></td>
                                        <td>{{ $result->item_name }}</td>
                                        <td>{{ $result->marka_name }}</td>
                                        <td>{{ $result->description }}</td>
                                        <td>{{ $result->vakkal_number }}</td>
                                        <td>{{ Helper::getLocationCode( (($chamber) ? $chamber->number : ' -- '),(($floor) ? $floor->number : ' -- '),(($grid) ? $grid->number : ' -- ') ) }}</td>
                                        <td>{{ $result->weight }}</td>
                                        <td>{{ $result->quantity }}</td>
                                        <td>{{ ($result->total_inward)-($result->total_outward) }}</td>
                                        <td>{{ $result->total_balance_weight }}</td>
                                    </tr>                                        
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
            @endforeach
            @else
                <div class="text-left mt-3 alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon noprint"></i> No data found to generate report. </div>                
            @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js') !!}    
@endsection

@section('page-scripts')
    {!! Html::script('/assets/admin/js/reports/full-ledger.js') !!}
@endsection