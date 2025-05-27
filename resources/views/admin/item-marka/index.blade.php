@php
    $counter=$first_item=intval($markas->firstItem());
    $last_item=intval($markas->lastItem());
    $total_records=$markas->total();
@endphp
@extends('admin.layouts.app')
@section('pagetitle',$pagetitle)

@section('plugin-css')
    {{ Html::style('/assets/app/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}
@endsection

@section('pagecontent')
    <!-- Page Heading Breadcrumbs -->
    @include('admin.layouts.breadcrumbs')
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div id="notify"></div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="mb-3">@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                {{ Form::model($request,array('url' =>route('admin.item-marka.index'),'method'=>'get','id'=>'form-filter')) }}
                    <div class="d-flex flex-wrap">                    
                        <div class="flex-nowrap flex-grow form-inline mr-3 mb-2">
                            <label class="mb-2 mr-2">Item:</label>
                            {!! Form::select('item_id', (array(""=>"Select Item") + $items->pluck('name','item_id')->toArray()), null , ['class' => 'form-control','onchange'=>'formsubmit()']) !!}
                        </div>
                        <div class="flex-grow mb-2">                            
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                {!! Form::text('keyword',null, array('class' => 'form-control','placeholder' => 'Search')) !!}
                            </div>                            
                        </div>                       
                        <div class="flex-grow text-right">
                            <a class="btn btn-rounded btn-primary btn-air" href="{{ route('admin.item-marka.create') }}">Add Marka</a>
                        </div>    
                    </div>
                {{ Form::close() }}                     
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="customers-table">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>#</th>
                                <th>Marka Name</th>
                                <th>Item Name</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    @if(isset($markas) && $markas->count()>0)
                        @foreach($markas as $marka)
                            <tr>
                                <td>{{ $counter++}}</td>                                
                                <td>{{ $marka->name }}</td>
                                <td>{{ $marka->item_name }}</td>
                                <td>{{ $marka->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.item-marka.edit',$marka->marka_id) }}" class="btn btn-sm btn-outline-info mb-1">
                                        <span class="btn-icon"><i class="la la-pencil"></i>Edit</span>
                                    </a>&nbsp;&nbsp;
                                    <button class="btn btn-sm btn-outline-danger mb-1" onclick="deleteMarka('{{ route('admin.item-marka.destroy',$marka->marka_id) }}');">
                                        <span class="btn-icon"><i class="la la-trash"></i>Delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                            <tr>
                                <td colspan="6"><div class="alert alert-danger has-icon"><i class="fa fa-exclamation-circle alert-icon"></i> No records found. </div></td>
                            <tr>
                    @endif
                        </tbody>
                    </table>
                    <div class="flexbox mb-4 mt-4 noprint">
                        <div class="form-inline noprint">                        
                            <div>@includeIf('admin.inc.entries', ['first' => $first_item,'last' => $last_item,'total' => $total_records])</div>
                        </div>
                        <div class="flexbox noprint">
                            @if($request->all())
                                {!! $markas->appends($request->all())->links() !!}
                            @else
                                {!! $markas->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin-scripts')
    {!! Html::script('/assets/app/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
@endsection

@section('page-scripts')
	{!! Html::script('/assets/admin/js/item-marka/index.js') !!}
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
