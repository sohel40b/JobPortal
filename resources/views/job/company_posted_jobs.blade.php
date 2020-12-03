@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Posted Jobs')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.company_dashboard_menu')

            <div class="col-md-9 col-sm-8">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pendingjob" role="tab" aria-controls="pendingjob" aria-selected="true">{{__('Pending Job')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#catagoriesjob" role="tab" aria-controls="catagoriesjob" aria-selected="false">{{__('Categoris Job')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#hotjob" role="tab" aria-controls="hotjob" aria-selected="false">{{__('Hot Job')}}</a>
                        </li>
                    </ul>

                <div class="tab-content formpanel mt0"> 
                    <div class="tab-pane fade show active" id="pendingjob">
                        <ul class="searchList">
                            <!-- job start --> 
                            @if(isset($jobs) && count($jobs))
                            @foreach($jobs as $job)
                            @php $company = $job->getCompany(); @endphp
                                <?php
                                    $active = App\ Job::getActiveById($job->is_active);
                                ?>
                                <?php
                                    $featured = App\ Job::getFeaturedById($job->is_featured);
                                ?>
                            @if(null == $active && null == $featured)
                            @if(null !== $company)
                            <li id="job_li_{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="jobinfo">
                                            <h3><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}" style="color: #21A614;">{{$job->title}}</a></h3>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Published: </span>{{$job->created_at->format('d M, Y')}}</label>
                                            </div>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Deadline: </span><span style="color: red;">{{$job->expiry_date->format('d M, Y')}}</span></label>
                                            </div>
                                            <div>
                                                @if(null == $active && null == $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: #21A614;">Categories Job</span></label>
                                                @elseif(null == $active && null !== $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: red;">Hot Job</span></label>
                                                @endif
                                            </div>
                                            <div>
                                                @if($job->isJobExpired())
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Expired</span></label>
                                                @elseif($job->is_active === 1)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span class="livebutton" style="color: white; font-weight: bold;"><small>Live </small><i class="fa fa-bullseye" style="color: red;"></i></span></label>
                                                @else
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Pending</span></label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    
                                    </div>
                                    <div class="col-md-3 col-sm-3">                
                                        <div class="listbtn1"><a href="{{route('list.favourite.applied.users', [$job->id])}}"><i class="fa fa-list"></i> {{__('Short Listed')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('list.applied.users', [$job->id])}}"><i class="fa fa-male"></i> {{__('Total Applications')}}</a></div>
                                        
                                        <div class="listbtn1">
                                            @if(null == $active && null == $featured)
                                                <a href="{{route('edit.front.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            @elseif(null == $active && null !== $featured)
                                                <a href="{{route('edit.hot.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            @endif
                                        </div>
                                        <div class="listbtn1"><a href="javascript:;" onclick="deleteJob({{$job->id}});"><i class="fa fa-trash"></i> {{__('Delete')}}</a></div>
                                    </div>
                                </div>
                            </li>
                            <!-- job end -->
                            @endif 
                            @elseif(null == $active && null !== $featured)
                            @if(null !== $company)
                            <li id="job_li_{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="jobinfo">
                                            <h3><a href="{{route('hot.job.detail', [$job->slug])}}" title="{{$job->title}}" style="color: #21A614;">{{$job->title}}</a></h3>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Published: </span>{{$job->created_at->format('d M, Y')}}</label>
                                            </div>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Deadline: </span><span style="color: red;">{{$job->expiry_date->format('d M, Y')}}</span></label>
                                            </div>
                                            <div>
                                                @if(null == $active && null == $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: #21A614;">Categories Job</span></label>
                                                @elseif(null == $active && null !== $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: red;">Hot Job</span></label>
                                                @endif
                                            </div>
                                            <div>
                                                @if($job->isJobExpired())
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Expired</span></label>
                                                @elseif($job->is_active === 1)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span class="livebutton" style="color: white; font-weight: bold;"><small>Live </small><i class="fa fa-bullseye" style="color: red;"></i></span></label>
                                                @else
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Pending</span></label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <div class="listbtn1"><a href="{{route('list.favourite.applied.users', [$job->id])}}"><i class="fa fa-list"></i> {{__('Short Listed')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('list.applied.users', [$job->id])}}"><i class="fa fa-male"></i> {{__('Total Applications')}}</a></div>
                                        <div class="listbtn1">
                                            @if(null == $active && null == $featured)
                                                <a href="{{route('edit.front.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            @elseif(null == $active && null !== $featured)
                                                <a href="{{route('edit.hot.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            @endif
                                        </div>
                                        <div class="listbtn1"><a href="javascript:;" onclick="deleteJob({{$job->id}});"><i class="fa fa-trash"></i> {{__('Delete')}}</a></div>
                                    </div>
                                </div>
                            </li>
                            <!-- job end -->
                            @endif 
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="catagoriesjob">
                        <ul class="searchList">
                            <!-- job start --> 
                            @if(isset($jobs) && count($jobs))
                            @foreach($jobs as $job)
                            @php $company = $job->getCompany(); @endphp
                                <?php
                                    $active = App\ Job::getActiveById($job->is_active);
                                ?>
                                <?php
                                    $featured = App\ Job::getFeaturedById($job->is_featured);
                                ?>
                            @if(null !== $active && null == $featured)
                            @if(null !== $company)
                            <li id="job_li_{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="jobinfo">
                                            <h3><a href="{{route('job.detail', [$job->slug])}}" title="{{$job->title}}" style="color: #21A614;">{{$job->title}}</a></h3>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Published: </span>{{$job->created_at->format('d M, Y')}}</label>
                                            </div>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Deadline: </span><span style="color: red;">{{$job->expiry_date->format('d M, Y')}}</span></label>
                                            </div>
                                            <div>
                                                @if(null !== $active && null == $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: #21A614;">Categories Job</span></label>
                                                @elseif(null !== $active && null !== $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: red;">Hot Job</span></label>
                                                @endif
                                            </div>
                                            <div>
                                                @if($job->isJobExpired())
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Expired</span></label>
                                                @elseif($job->is_active === 1)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span class="livebutton" style="color: white; font-weight: bold;"><small>Live </small><i class="fa fa-bullseye" style="color: red;"></i></span></label>
                                                @else
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Pending</span></label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    
                                    </div>
                                    <div class="col-md-3 col-sm-3">                
                                        <div class="listbtn1"><a href="{{route('list.favourite.applied.users', [$job->id])}}"><i class="fa fa-list"></i> {{__('Short Listed')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('list.applied.users', [$job->id])}}"><i class="fa fa-male"></i> {{__('Total Applications')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('edit.front.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a></div>
                                        <div class="listbtn1"><a href="javascript:;" onclick="deleteJob({{$job->id}});"><i class="fa fa-trash"></i> {{__('Delete')}}</a></div>
                                    </div>
                                </div>
                            </li>
                            <!-- job end -->
                            @endif 
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="hotjob">
                        <ul class="searchList">
                            <!-- job start --> 
                            @if(isset($jobs) && count($jobs))
                            @foreach($jobs as $job)
                            @php $company = $job->getCompany(); @endphp
                                <?php
                                    $active = App\ Job::getActiveById($job->is_active);
                                ?>
                                <?php
                                    $featured = App\ Job::getFeaturedById($job->is_featured);
                                ?>
                            @if(null !== $active && null !== $featured)
                            @if(null !== $company)
                            <li id="job_li_{{$job->id}}">
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <div class="jobinfo">
                                            <h3><a href="{{route('hot.job.detail', [$job->slug])}}" title="{{$job->title}}" style="color: #21A614;">{{$job->title}}</a></h3>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Published: </span>{{$job->created_at->format('d M, Y')}}</label>
                                            </div>
                                            <div>
                                                <label class="listbtn"><span style="font-weight: bold;">Deadline: </span><span style="color: red;">{{$job->expiry_date->format('d M, Y')}}</span></label>
                                            </div>
                                            <div>
                                                @if(null !== $active && null == $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: #21A614;">Categories Job</span></label>
                                                @elseif(null !== $active && null !== $featured)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Type: </span><span style="color: red;">Hot Job</span></label>
                                                @endif
                                            </div>
                                            <div>
                                                @if($job->isJobExpired())
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Expired</span></label>
                                                @elseif($job->is_active === 1)
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span class="livebutton" style="color: white; font-weight: bold;"><small>Live </small><i class="fa fa-bullseye" style="color: red;"></i></span></label>
                                                @else
                                                <label class="listbtn"><span style="font-weight: bold;">Job Status: </span><span style="color: red; font-weight: bold;">Pending</span></label>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    
                                    </div>
                                    <div class="col-md-3 col-sm-3">                
                                        <div class="listbtn1"><a href="{{route('list.favourite.applied.users', [$job->id])}}"><i class="fa fa-list"></i> {{__('Short Listed')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('list.applied.users', [$job->id])}}"><i class="fa fa-male"></i> {{__('Total Applications')}}</a></div>
                                        <div class="listbtn1"><a href="{{route('edit.hot.job', [$job->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a></div>
                                        <div class="listbtn1"><a href="javascript:;" onclick="deleteJob({{$job->id}});"><i class="fa fa-trash"></i> {{__('Delete')}}</a></div>
                                    </div>
                                </div>
                            </li>
                            <!-- job end -->
                            @endif 
                            @endif
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts')
<script type="text/javascript">
    function deleteJob(id) {
    var msg = 'Are you sure?';
    if (confirm(msg)) {
    $.post("{{ route('delete.front.job') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            if (response == 'ok')
            {
            $('#job_li_' + id).remove();
            } else
            {
            alert('Request Failed!');
            }
            });
    }
    }
</script>
@endpush