<div class="header">
    <div class="container-fluid" style="background-color: #f5f6f7;">
        <div class="row">
            <div class="col-lg-2 col-md-12 col-12"> <a href="{{url('/')}}" class="logo"><img src="{{ asset('/') }}sitesetting_images/thumb/{{ $siteSetting->site_logo }}" alt="{{ $siteSetting->site_name }}" /></a>
                <div class="navbar-header navbar-light">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-10 col-md-12 col-12"> 
                <!-- Nav start -->
                <nav class="navbar navbar-expand-lg navbar-light">
					
                    <div class="navbar-collapse collapse" id="nav-main">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item {{ Request::url() == route('training.home') ? 'active' : '' }}"><a href="{{url('/training-home')}}" class="nav-link">{{__('Home')}}</a> </li>

                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 1')}}</a> </li>
                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 2')}}</a> </li>
                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 3')}}</a> </li>
                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 4')}}</a> </li>
                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 5')}}</a> </li>
                            <li class="nav-item"><a href="" class="nav-link">{{__('Training 6')}}</a> </li>
                            @if(!Auth::guard('student')->check())
                            <li class="nav-item"><a href="{{ route('signin') }}" class="nav-link">{{__('Login')}}</a> </li>
                            <li class="nav-item"><a href="{{ route('signup') }}" class="nav-link register">{{__('Registration')}}</a> </li>
                            @endif
                            <li class="nav-item"><a href="" class="nav-link">{{__('Search')}}</a> </li>

                            @if(Auth::guard('student')->check())
                                <li class="nav-item dropdown">
                                    <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::guard('student')->user()->name }}<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                                        <a href="{{route('training.home')}}" class="dropdown-item"> <i class="fa fa-home" aria-hidden="true"></i> {{__('Dashboard')}}</a>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#student-logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i> {{__('Logout')}}
                                        </a>
                                        <form id="student-logout-form" action="{{ route('training.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        </form>

                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </nav>
                <!-- Nav end --> 
            </div>
        </div>
        <!-- row end --> 
    </div>
    <!-- Header container end --> 
</div>