@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Applied Cv Search By Company')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row">
            @include('includes.company_dashboard_menu')
            <!-- Job Seeker Search List Form start -->
            <div class="col-md-9 col-sm-9"> 
                <form action="{{route('company.cv.sorting')}}" method="get">
                    <div class="pageSearch">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="searchform">
                                        <div class="row">
                                            <div class="col-md-3"> {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!} </div>
                                            <div class="col-md-3"> {!! Form::select('career_level_id[]', ['' => __('Select Carrer Level')]+$careerLevels, Request::get('career_level_id', null), array('class'=>'form-control', 'id'=>'career_level_id')) !!} </div>
                                            <div class="col-md-3"> {!! Form::select('job_experience_id[]', ['' => __('Select Job Experience')]+$jobExperiences, Request::get('job_experience_id', null), array('class'=>'form-control', 'id'=>'job_experience_id')) !!} </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Job Seeker Search List Form End -->
                <form action="{{route('company.cv.sorting')}}" method="get">
                    <!-- Search Result and sidebar start -->
                    <div class="row" style="margin-top: 20px;">               
                        <div class="col-md-12 col-sm-12"> 
                            <!-- Search List -->
                            <ul class="searchList">
                                <!-- job start --> 
                                @if(isset($jobSeekers) && count($jobSeekers))
                                @foreach($jobSeekers as $jobSeeker)
                                <li>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="jobimg">{{$jobSeeker->printUserImage(100, 100)}}</div>
                                            <div class="jobinfo">
                                                <h3><a href="#">{{$jobSeeker->getName()}}</a></h3>
                                                <div class="location"> {{$jobSeeker->getLocation()}}</div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="listbtn"><a href="{{route('user.profile', $jobSeeker->id)}}">{{__('View Profile')}}</a></div>
                                        </div>
                                    </div>
                                    <p>{{str_limit($jobSeeker->getProfileSummary('summary'),150,'...')}}</p>
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
                            <!-- Pagination end --> 
                            <div class=""><br />{!! $siteSetting->listing_page_horizontal_ad !!}</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
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