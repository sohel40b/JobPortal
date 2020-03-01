@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
.pageSearch {
	padding: 20px 0;
	background: #fff;
	    border-bottom: 1px solid #ddd;
    box-shadow:0px 5px 20px rgba(0,0,0,0.1);
	position: relative;
}
.pageSearch .searchform{ margin: 0 auto;}
.pageSearch a.btn {
	background: #ea5c90;
	color: #fff;
	padding: 13px 15px;
	font-size: 16px;
	text-transform: uppercase;
	font-weight: 600;
	border-radius: 0;
	display: block;
}
.pageSearch a.btn i {
	font-weight: 400;
	font-size: 16px;
	margin-right: 5px;
}
.pageSearch a.btn:hover {
	background: #666;
}
.searchform .row {
	margin: 0 -5px;
}
.searchform .col-md-3, .searchform .col-md-2, .searchform .col-sm-3, .searchform .col-sm-2 {
	padding: 0 5px;
}
.searchform .form-control {
	height: auto;
	padding: 13px 12px;
	font-size: 16px;
}
.searchform select.form-control {
	padding: 13px 12px;
	background: #fff;
	line-height: 45px;
}
.searchform .btn {
	background:#17d27c;
	font-size: 16px;
	color: #fff;
	padding:14px 20px;
	width: 100%;
}
.searchform .btn:hover {
	background: #444;
}
 /*Listing*/
 .listpgWraper {
    background: #f0f0f0;
    padding: 30px 0;
	min-height: 400px;
    
}
.listbtn1{
	margin-top: 10px;
}
.listbtn1 a{
	background: #fff;
	display: block;
	border-radius: 40px;
	width: 100%;
	color: rgb(22, 22, 22);
	font-weight: 700;
	padding: 8px 13px;
	text-align: center;
	border: 1px solid #09be3f;
}
.searchList {
    margin-left: -40px;
	list-style: none;
	margin-bottom: 30px;
}
.searchList li {
	background: #fff;
	border-bottom: 1px solid #e4e4e4;
	padding: 20px;
	margin-bottom: 10px;
	border-radius: 5px;
}
.searchList li:hover {
	box-shadow:3px 8px 10px rgba(0,0,0,0.1);
	border-bottom-color:#ea5c90;
}
.searchList li .jobimg {
	float: left;
	width: 70px;
	margin-right: 15px;
}
.searchList li h3 a {
	font-size: 18px;
	font-weight: 600;
	color: #000;
}
.searchList li .companyName {
	margin: 10px 0;
	color: #969595;
}
.searchList li .companyName a {
	color: #969595;
}
.searchList li a:hover {
	color: #333;
}
.searchList li .location {
	color: #000;
}
.searchList li .location span {
	color: #333;
}
.searchList li .listbtn {
	margin-top: 20px;
}
.searchList li .listbtn a {
	background: #fff;
	display: block;
	border-radius: 40px;
	width: 100%;
	color: #ea5c90;
	text-transform: uppercase;
	font-weight: 700;
	padding: 10px 15px;
	text-align: center;
	border: 1px solid #ea5c90;
}
.searchList li .listbtn a:hover {
	background: #ea5c90;
	color: #fff;
	text-decoration: none;
}
.searchList li p {
	line-height: 22px;
	color: #333;
	margin: 10px 0 0 0;
}
.searchList li .cateinfo {
	color: #ea5c90;
	margin: 10px 0;
}
.searchList li .minsalary {
	font-size: 22px;
	font-weight: 700;
	text-align: center;
	margin-top: 25px;
	color: #17d27c;
}
.searchList li .minsalary span {
	color: #999;
	font-weight: 400;
}
.jobinfo{
    margin-top: -25px;
}
.pagiWrap .showreslt {
	font-weight: 600;
	margin-top: 10px;
}
.pagiWrap .pagination {
	text-align: right;
	margin: 0;
}
.pagiWrap .showreslt {
	margin-bottom: 10px;
}
</style>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>CV</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage CV <small>CV</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">CV</span> </div>
                    </div>

                <!-- Start Search BOX -->
                    <form action="{{route('cv.list')}}" method="get">
                        <!-- Page Title start -->
                        <div class="pageSearch">
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-14">
                                    <div class="searchform">
                                        <div class="row">
                                            <div class="col-md-2"> {!! Form::select('career_level_id[]', ['' => __('Select Career level')]+$careerLevels, Request::get('career_level_id', null), array('class'=>'form-control', 'id'=>'career_level_id')) !!} </div>
                                            <div class="col-md-2"> {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!} </div>
                                            <div class="col-md-2"> {!! Form::select('job_experience_id[]', ['' => __('Select Job Experience')]+$jobExperiences, Request::get('job_experience_id', null), array('class'=>'form-control', 'id'=>'job_experience_id')) !!} </div>
                                            
                                            
                                            <div class="col-md-2">
                                                <input type="text" name="search" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('Enter Skills or job seeker details')}}" />
                                            </div>

                                            <div class="col-md-1">
                                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                        </div>
                        <!-- Page Title end -->
                    </form>
                <!-- END Search BOX -->

                    <!-- Start CV List -->

                    <div class="listpgWraper">
                        <div class="container">
                            
                            <form action="{{route('cv.list')}}" method="get">
                                <!-- Search Result and sidebar start -->
                                <div class="row">             
                                    <div class="col-lg-10"> 
                                        <!-- Search List -->
                                        <ul class="searchList">
                                            <!-- job start --> 
                                            @if(isset($jobSeekers) && count($jobSeekers))
                                            @foreach($jobSeekers as $jobSeeker)
                                            <li>
                                                <div class="row">
                                                    <div class="col-lg-1.5 col-md-1.5">
                                                        <div class="jobimg">{{$jobSeeker->printUserImage(100, 100)}}</div>
                                                    </div>
                                                    <div class="col-lg-7 col-md-7">
                                                        <div class="jobinfo">
                                                            <h3 ><a href="#" class="location"> {{$jobSeeker->getName()}}</a></h3>
                                                            <div class="location"> {{$jobSeeker->email}}</div>
                                                            <div class="location"> {{$jobSeeker->getAge()}} Years</div>
                                                            <div class="location"> ({{$jobSeeker->phone}}) ({{$jobSeeker->mobile_num}})</div>
                                                            <div class="location"> {{$jobSeeker->getLocation()}}</div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <!--<div class="location"><a href=""><i class="fa fa-file" style="color: red; font-size: 20px;"></i></a></div>-->
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- job end --> 
                                            @endforeach
                                            @endif
                                        </ul>

                                        <!-- Pagination Start -->
                                        <div class="pagiWrap">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="showreslt">
                                                        {{__('Showing Pages')}} : {{ $jobSeekers->firstItem() }} - {{ $jobSeekers->lastItem() }} {{__('Total')}} {{ $jobSeekers->total() }}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 text-right">
                                                    @if(isset($jobSeekers) && count($jobSeekers))
                                                    {{ $jobSeekers->appends(request()->query())->links() }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!-- END CV List -->

                    
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>

@endsection
@push('styles')
<style type="text/css">
    .searchList li .jobimg {
        min-height: 80px;
    }
    .hide_vm_ul{
        height:100px;
        overflow:hidden;
    }
    .hide_vm{
        display:none !important;
    }
    .view_more{
        cursor:pointer;
    }
</style>
@endpush
@push('scripts') 
<script>
    $(document).ready(function ($) {
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);

        $(".view_more_ul").each(function () {
            if ($(this).height() > 100)
            {
                $(this).addClass('hide_vm_ul');
                $(this).next().removeClass('hide_vm');
            }
        });
        $('.view_more').on('click', function (e) {
            e.preventDefault();
            $(this).prev().removeClass('hide_vm_ul');
            $(this).addClass('hide_vm');
        });

    });
</script>
@include('includes.country_state_city_js')
@endpush