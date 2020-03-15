@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Job Applications List B')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
                <div class="myads">
                    <h3>{{__('Job Applications List')}}</h3>
                    <!-- As a link -->
                    <form action="{{url('/list-applied-users/{job_id}')}}" method="get">
                        <div class="pageSearch">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="searchform">
                                            <div class="row">
                                                <div class="col-md-3"> {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!} </div>
                                                <div class="col-md-3"> {!! Form::select('career_level_id[]', ['' => __('Select Career Level')]+$careerLevels, Request::get('career_level_id', null), array('class'=>'form-control', 'id'=>'career_level_id')) !!} </div>
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
                    <form action="{{url('/list-applied-users/{job_id}')}}" method="get">
                    <ul class="searchList" style="margin-top: 20px;">
                        <!-- job start --> 
                        @if(isset($job_applications) && count($job_applications))
                        @foreach($job_applications as $job_application)
                        @php
                        $user = $job_application->getUser();
                        $job = $job_application->getJob();
                        $company = $job->getCompany();              
                        @endphp
                        @if(null !== $job_application && null !== $user && null !== $job && null !== $company)
                        <li>
                            <div class="row">
                                <div class="col-md-1 col-sm-1">
                                        <div class="jobimg">{{$user->printUserImage(100, 100)}}</div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="jobinfo" style="margin-left:30px;">
                                        <h3><a href="{{route('applicant.profile', $job_application->id)}}">{{$user->getName()}}</a></h3>
                                        <div class="location"> <i class="fa fa-map-marker" aria-hidden="true" style="color:green;"></i> {{$user->getLocation()}}</div>
                                        <div class="location"> <i class="fa fa-phone" style="color:green;"></i> {{$user->mobile_num}}, {{$user->phone}}</div>
                                        <div class="location">{{$user->getAge()}} Years </div>
                                        @if (isset($user) && count($user->profileEducation))
                                        @foreach ($user->profileEducation as $education)
                                            <div class="location">{{$education->institution}} </div>
                                            <div class="location">{{$education->getDegreeLevel('degree_level')}} </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="minsalary">{{$job_application->expected_salary}} {{$job_application->salary_currency}} <span>/ {{$job->getSalaryPeriod('salary_period')}}</span></div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    @if(isset($job) && isset($company))
                                    @if(Auth::guard('company')->check() && Auth::guard('company')->user()->isFavouriteApplicant($user->id, $job->id, $company->id))
                                    <div class="button1 button2"><a href="{{route('remove.from.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}"> <i class="fa fa-times" style="color:white;"></i></a></div>
                                    @else
                                    <div class="button1"><a href="{{route('add.to.favourite.applicant', [$job_application->id, $user->id, $job->id, $company->id])}}"> <i class="fa fa-check" style="color:white;"></i></a></div>
                                    @endif
                                    @endif
                                    <div class="button1"><a href="{{route('applicant.profile', $job_application->id)}}"><i class="fa fa-file" style="color:white;"></i></a></div>
                                    <div class="button1"><a href="javascript:;" onclick="send_message()" >  <i class="fa fa-envelope" style="color:white;"></i></a></div>
                                    <div class="button1 button6"><a href=""><i class="fa fa-times" style="color:white;"></i></a></div>
                                </div>
                            </div>
                        </li>
                        <!-- job end --> 
                        @endif
                        @endforeach
                        @endif
                    </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection