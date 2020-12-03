@extends('layouts.app')
@section('content') 
<!-- Header Start -->
@include('includes.training_header')
<!-- Header End -->
<div class="listpgWraper" style="background: #13a130; color: white;">
	<div class="container">		
        <h3>{{__($training->title)}}</h3>
        <div style="margin-top: 40px;">
            <p><i class="fa fa-circle" aria-hidden="true"></i> {{__('Course Start Date')}} : </p>
            <p style="margin-top: 6px;"><i class="fa fa-circle" aria-hidden="true"></i> {{__('Last Date Of Registration')}} : </p>
            <p style="margin-top: 6px;"><i class="fa fa-calendar" aria-hidden="true"></i> {{__('Course Schedule Time')}} : {{__($training->course_time)}}</p>
            <p style="margin-top: 6px;"><i class="fa fa-circle" aria-hidden="true"></i> {{__('Training Duration')}} : {{__($training->duration)}}</p>
            <p style="margin-top: 6px;"><i class="fa fa-calendar" aria-hidden="true"></i> {{__('Class Schedule')}} : {{__($training->class_schedule)}}</p>
            <p style="margin-top: 6px;"><i class="fa fa-bars" aria-hidden="true"></i> {{__('No. of Classes/Sessions')}} : {{__($training->no_of_class)}}</p>
            <p style="margin-top: 6px;"><i class="fa fa-map" aria-hidden="true"></i> {{__('Venue')}} : {{__($training->venue)}}</p>
        </div>
	</div>
</div>
<div class="listpgWraper">
    <div class="container"> 
        <!-- Training Detail start -->
        <div class="row">
            <div class="col-lg-8"> 	
                <!-- Training Description start -->
                <div class="job-header">
                    <div class="contentbox">
                        <p>{!! $training->description !!}</p>                       
                    </div>
                </div>
            </div>
            <!-- Training Description End -->
            <div class="col-lg-4"> 
				<div class="jobButtons applybox">
                    <h3 style="text-align:left">{{__('Price')}} : {{__('TK. 3,500+VAT')}}</h3>
                    <p style="text-align:left;">{{__('(15% VAT is applicable in every purchase.)')}}</p>
                    <a href="" class="btn apply" style="margin-top:30px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> {{__('Register Now')}}</a>
				</div>
				<div class="companyinfo">
                    <h3 style="color: black;"><i class="fa fa-building-o" aria-hidden="true"></i> {{__('Resource Person')}}</h3>
                    <div class="title"><a href=""></a></div>
                    <div class="ptext"></div>
                    <div class="opening">
                        <a href="">
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="companyoverview">
                        <p> <a href="">Read More</a></p>
                    </div>
                </div>
                <div class="companyinfo">
                    <h3 style="color: black;"><i class="fa fa-building-o" aria-hidden="true"></i> {{__('Who Can Attend')}}</h3>
                    <p>Accounts & Finance Managers, Tax Managers, HR Managers, Tax Consultants, entrepreneurs & would be entrepreneurs.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
