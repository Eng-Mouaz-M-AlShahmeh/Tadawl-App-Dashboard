@extends('dashboard.layouts.auth')
@section('title', __('backend.signedInToControl'))
@section('content')
    <div class="center-block w-xxl p-t-3">
        <div class="p-a-md box-color r box-shadow-z4 text-color m-b-0">
            <div class="text-center">
                @if(Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code) !="")
                    <img alt="" class="app-logo"
                         src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code)) }}">
                @else
                    <img width="100px" hieght="100px" alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                @endif
            </div>
            <div class="m-y text-muted text-center">
                {{ __('backend.signedInToControl') }}
            </div>
            <form name="form" method="POST" action="{{ url('/'.env('BACKEND_PATH').'/login') }}">
                {{ csrf_field() }}
                @if($errors ->any())
                    <div class="alert alert-danger m-b-0">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="md-form-group float-label {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" name="email" value="{{ old('email') }}" class="md-input" required>
                    <label>{{ __('backend.connectEmail') }}</label>
                </div>
                <div class="md-form-group float-label {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="md-input" required>
                    <label>{{ __('backend.connectPassword') }}</label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
                <div class="m-b-md text-left">
                    <label class="md-check">
                        <input type="checkbox" name="remember"><i
                            class="primary"></i> {{ __('backend.keepMeSignedIn') }}
                    </label>
                </div>
                <button type="submit" class="btn primary btn-block p-x-md m-b">{{ __('backend.signIn') }}</button>
            </form>
            @if(env("FACEBOOK_STATUS") && env("FACEBOOK_ID") && env("FACEBOOK_SECRET"))
                <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block text-left">
                    <i class="fa fa-facebook"></i> {{ __('backend.loginWithFacebook') }}
                </a>
            @endif
            @if(env("TWITTER_STATUS") && env("TWITTER_ID") && env("TWITTER_SECRET"))
                <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-info btn-block text-left">
                    <i class="fa  fa-twitter"></i> {{ __('backend.loginWithTwitter') }}
                </a>
            @endif
            @if(env("GOOGLE_STATUS") && env("GOOGLE_ID") && env("GOOGLE_SECRET"))
                <a href="{{ route('social.oauth', 'google') }}" class="btn danger btn-block text-left">
                    <i class="fa fa-google"></i> {{ __('backend.loginWithGoogle') }}
                </a>
            @endif
            @if(env("LINKEDIN_STATUS") && env("LINKEDIN_ID") && env("LINKEDIN_SECRET"))
                <a href="{{ route('social.oauth', 'linkedin') }}" class="btn btn-primary btn-block text-left">
                    <i class="fa fa-linkedin"></i> {{ __('backend.loginWithLinkedIn') }}
                </a>
            @endif
            @if(env("GITHUB_STATUS") && env("GITHUB_ID") && env("GITHUB_SECRET"))
                <a href="{{ route('social.oauth', 'github') }}" class="btn btn-default dark btn-block text-left">
                    <i class="fa fa-github"></i> {{ __('backend.loginWithGitHub') }}
                </a>
            @endif
            @if(env("BITBUCKET_STATUS") && env("BITBUCKET_ID") && env("BITBUCKET_SECRET"))
                <a href="{{ route('social.oauth', 'bitbucket') }}" class="btn primary btn-block text-left">
                    <i class="fa fa-bitbucket"></i> {{ __('backend.loginWithBitbucket') }}
                </a>
            @endif

            @if(Helper::GeneralWebmasterSettings("register_status"))
                <a href="{{ url('/'.env('BACKEND_PATH').'/register') }}" class="btn info btn-block text-left">
                    <i class="fa fa-user-plus"></i> {{ __('backend.createNewAccount') }}
                </a>
            @endif
            <div class="p-v-lg text-center">
                <div class="m-t"><a href="{{ url('/'.env('BACKEND_PATH').'/password/reset') }}"
                                    class="text-primary _600">{{ __('backend.forgotPassword') }}</a></div>
            </div>

        </div>


    </div>
@endsection

