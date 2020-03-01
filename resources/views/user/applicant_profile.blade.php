@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__($page_title)]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row">@if(!Auth::guard('company')->check()) 
                              @include('includes.user_dashboard_menu') 
                         @endif
          <!-- Page Container -->
          <div class="w3-content w3-margin-top" style="Width:75%; height:auto;">
            <!-- The Grid -->
            <div class="w3-row-padding">

              <!-- Left Column -->
              <div class="w3-third">
              
                <div class="w3-white w3-text-grey w3-card-4">
                  <div class="w3-display-container">
                  <div class="userPic w3-center">{{$user->printUserImage()}}</div>
                  </div>
                  <div class="w3-container w3-margin-top">
                    <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$user->getName()}}</p>
                    <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$user->getCareerLevel('career_level')}}</p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$user->email}}</p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$user->mobile_num}}</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>{{$user->street_address}}</p>

                    <hr>
                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
                    <p class="w3-margin-top"><div id="skill_div"></div></p>

                    <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
                    <p class="w3-margin-top"><div id="language_div"></div></p>

                  </div>
                </div><br>

              <!-- End Left Column -->
              </div>

              <!-- Right Column -->
              <div class="w3-twothird">
              
                <div class="w3-container w3-card w3-white w3-margin-bottom">
                  <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>
                    <div class="" id="experience_div"></div>            
                    <hr>
                </div>

                <div class="w3-container w3-card w3-white">
                  <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                    <div class="" id="education_div"></div>            
                    <hr>
                </div>

              <!-- End Right Column -->
              </div>
              
            <!-- End Grid -->
            </div>

            <!-- End Page Container -->
            </div>


        </div>
    </div>
</div>

@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .formrow iframe {
        height: 78px;
    }
</style>
@endpush
@push('scripts') 
<script type="text/javascript">
    showEducation();
    showExperience();
    showSkills();
    showLanguages();
    function showExperience()
    {
    $.post("{{ route('show.applicant.profile.experience', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            $('#experience_div').html(response);
            });
    }
    function showEducation()
    {
    $.post("{{ route('show.applicant.profile.education', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            $('#education_div').html(response);
            });
    }
    function showLanguages()
    {
    $.post("{{ route('show.applicant.profile.languages', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            $('#language_div').html(response);
            });
    }
    function showSkills()
    {
    $.post("{{ route('show.applicant.profile.skills', $user->id) }}", {user_id: {{$user->id}}, _method: 'POST', _token: '{{ csrf_token() }}'})
            .done(function (response) {
            $('#skill_div').html(response);
            });
    }


</script> 
@endpush