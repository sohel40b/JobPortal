@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('My Profile')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8">@include('flash::message')
				    <ul class="nav nav-tabs" id="myTab" role="tablist" > 
                        <li class="nav-item"><a data-toggle="tab" href="#userprofile" class="nav-link active">{{__('Personal')}}</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#usersummary" class="nav-link" >{{__('Objective')}}</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#userexperience" class="nav-link" >{{__('Experience')}}</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#usereducation" class="nav-link" >{{__('Education')}}</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#userskills" class="nav-link" >{{__('Skills')}}</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#userlanguage" class="nav-link" >{{__('Language')}}</a></li>
                    </ul>
                    
                <div class="userccount">
            
                    <div class="tab-content formpanel mt0">
                        <div id="userprofile" class="tab-pane fade show active">
                        @include('user.inc.profile') 
                        </div>
                        <div id="usersummary" class="tab-pane fade">
                        @include('user.inc.summary')
                        </div>
                        <div id="userexperience" class="tab-pane fade">
                        @include('user.forms.experience.experience')
                        </div>
                        <div id="usereducation" class="tab-pane fade">
                        @include('user.forms.education.education')
                        </div>
                        <div id="userskills" class="tab-pane fade">
                        @include('user.forms.skill.skills')
                        </div>
                        <div  id="userlanguage" class="tab-pane fade">
                        @include('user.forms.language.languages')
                        </div>
                    </div>			
                </div>
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
@push('scripts')
@include('includes.immediate_available_btn')
@endpush