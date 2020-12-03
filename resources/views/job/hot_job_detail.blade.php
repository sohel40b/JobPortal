@extends('layouts.app')
@section('content')
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__(' Hot Job Detail')]) 
<!-- Inner Page Title end -->
@include('flash::message')

@php
$company = $job->getCompany();
@endphp

<div class="listpgWraper" style="background:#FFFFFF;">
    <div class="container">
        @include('flash::message')
        <!-- Job Detail start -->
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-9"> 
				<!-- Job Header start -->
                <div class="job-header" style="background: #DEE1E6;">

                        <div class="contentbox" style="background: #395723; padding: 40px 50px; width:100%; text-align:center; font-size:35px; font-weight:bold;">
                            <a href="#" style="color:white;">Banner</a>
                        </div>

                        <div class="jobinfo">
                            <h2>{{$job->title}} - {{$company->name}}</h2>
                        </div>

                        <div class="contentbox">
                            <a class="font-weight-bold">{{__('Vacancy')}}: {{$job->num_of_positions}}</a> 
                            <p></p>
                            <a class="font-weight-bold">{{__('job Responsibilities')}}</a>
                            <p>{!! $job->description !!}</p> 

                            <a class="font-weight-bold">{{__('Employment Status')}}</a>
                            <p>{{$job->getJobType('job_type') }}</p> 

                            <a class="font-weight-bold">{{__('Educational Requirements')}}</a>
                            <p>{{$job->getDegreeLevel('degree_level') }}</p> 

                            <a class="font-weight-bold">{{__('Experience Requirements')}}</a>
                            <p>{{$job->getJobExperience('job_experience') }}</p> 

                            <a class="font-weight-bold">{{__('Additional Requirements')}}</a>
                            <p>{!!$job->getJobSkillsStr()!!}</p> 

                            <a class="font-weight-bold">{{__('Job Location')}}</a>
                            <p>{{$job->getLocation() }}</p>
                            @if(!(bool)$job->hide_salary)
                            <a class="font-weight-bold">{{__('Salary')}}</a>
                            <p>{{__('Monthly Salary')}}: <strong>{{$job->salary_from.' '.$job->salary_currency}} - {{$job->salary_to.' '.$job->salary_currency}}</strong></p>
                            @endif 

                            <a class="font-weight-bold">{{__('Compensation & Other Benefits')}}</a>
                            <p>{!! $job->benefits !!}</p> 
                            <hr>
                            <div class="jobButtons applybox" style="background:#DEE1E6;">
                                @if($job->isJobExpired())
                                <span class="jbexpire"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Job is expired')}}</span>
                                @elseif(Auth::check() && Auth::user()->isAppliedOnJob($job->id))
                                <a href="javascript:;" class="btn apply applied"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Already Applied')}}</a>
                                @else
                                    @if(!Auth::guard('company')->check())
                                    <a href="{{route('apply.job', $job->slug)}}" class="btn apply"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Apply Now')}}</a>
                                    @endif
                                @endif
                            </div>  

                        </div>
                        <!--<div class="jobButtons">
                            <a href="{{route('email.to.friend', $job->slug)}}" class="btn"><i class="fa fa-envelope" aria-hidden="true"></i> {{__('Email to Friend')}}</a>
                            @if(Auth::check() && Auth::user()->isFavouriteJob($job->slug)) <a href="{{route('remove.from.favourite', $job->slug)}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Favourite Job')}} </a> @else <a href="{{route('add.to.favourite', $job->slug)}}" class="btn"><i class="fa fa-floppy-o" aria-hidden="true"></i> {{__('Add to Favourite')}}</a> @endif
                            <a href="{{route('report.abuse', $job->slug)}}" class="btn report"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{__('Report Abuse')}}</a>
                        </div>-->
   
                    </div>
                </div>
            <!-- Job Description end --> 
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .view_more{display:none !important;}
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
                $(this).css('height', 100);
                $(this).css('overflow', 'hidden');
                //alert($( this ).next());
                $(this).next().removeClass('view_more');
            }
        });

    });
</script> 
@endpush