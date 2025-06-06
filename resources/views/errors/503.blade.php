@extends('errors.layout.layout') 

@section('pagetitle')
    Error 503
@endsection

@section('page-css')
<style>
    body {
        background-color: #fff;
        background-repeat: no-repeat;
        background-image: url(/assets/admin/img/icons/tools-2.svg);
        background-position: 80% 10px;
    }

    .error-content {
        max-width: 620px;
        margin: 200px auto 0;
    }

    .error-icon {
        height: 160px;
        width: 160px;
        background-image: url(/assets/admin/img/icons/tools.svg);
        background-size: cover;
        background-repeat: no-repeat;
        margin-right: 80px;
    }

    .error-code {
        font-size: 120px;
        color: #5c6bc0;
    }
</style>
@endsection

@section('page-content')
<span class="error-icon"></span>
<div class="flex-1">
    <h1 class="font-strong">Be Right Back!</h1>    
</div>    
@endsection 