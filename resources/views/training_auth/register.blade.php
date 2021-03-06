@extends('layouts.app')
<!-- Header Start -->
@include('includes.training_header')
<!-- Header End -->
@section('content')

<body class="name">
    <div class="user">
        <header class="user__header">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
            <h1 class="user__title">Registration here!</h1>
        </header>
        
        <form action="{{url('training-register')}}" method="POST" class="form">
        {{ csrf_field() }}

            <div class="form__group">
                <input type="text" name="name" class="form__input" value="{{ old('name') }}" placeholder="Full name" autofocus>
                @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif 
            </div>

            <div class="form__group">
                <input type="email" name="email" class="form__input" value="{{ old('email') }}" placeholder="Email address" >
                @if ($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="form__group">
                <input type="password" name="password" class="form__input" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form__group">
                <input type="password" name="password_confirmation" class="form__input" placeholder="Confirm Password">
                @if ($errors->has('password'))
                    <span class="error">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <button class="btn" type="submit">Registration</button>
        </form>
    </div>
</body>
<!-- Footer Start -->
@include('includes.footer')
<!-- Footer End -->
@endsection
