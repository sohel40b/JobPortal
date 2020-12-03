@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Job Post Type')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-9"> 
                <nav class="navbar navbar-light bg-light" style="padding:20px 20px;">
                    <span class="navbar-text" style="color:green;">
                    <span style="color:red; font-weight:bold;">Welcome to TaxmanBD,</span> <br> <br>
                    TaxmanBD Provied Two Type Job Post Free of Cost.........
                    </span>
                    <br>
                </nav>
                <br>
                <h6>Job Categories</h6>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('post.job') }}">Categories Job</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('post.hot.job') }}">Hot Job</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush