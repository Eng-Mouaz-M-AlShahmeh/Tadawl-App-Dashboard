@if(Helper::GeneralWebmasterSettings("register_status"))
    @extends('dashboard.layouts.auth')
    @section('title', __('backend.createNewAccount'))
@section('content')
    <div class="center-block w-xxl p-t-3">
        <div class="p-a-md box-color r box-shadow-z4 text-color">
            <div class="text-center">
                @if(Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code) !="")
                    <img alt="" class="app-logo"
                         src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code)) }}">
                @else
                    <img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                @endif
            </div>
            <div class="m-y text-muted text-center">
                {{ __('backend.newUser') }}
            </div>
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                @if ($errors->has('name'))
                    <div class="alert alert-warning">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-warning">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-warning">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <div class="md-form-group">
                    <input id="name" type="text" class="md-input" name="name" value="{{ old('name') }}" required
                           autofocus>
                    <label>{{ __('backend.fullName') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="email" type="email" class="md-input" name="email" value="{{ old('email') }}" required>

                    <label>{{ __('backend.connectEmail') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password" type="password" class="md-input" name="password" required>
                    <label>{{ __('backend.connectPassword') }}</label>
                </div>
                <div class="md-form-group">
                    <input id="password-confirm" type="password" class="md-input" name="password_confirmation" required>
                    <label>{{ __('backend.confirmPassword') }}</label>
                </div>

                <button type="submit" class="btn primary btn-block p-x-md"><i
                        class="material-icons">&#xe7fe;</i> {{ __('backend.createNewAccount') }}</button>
            </form>

            <div class="p-v-lg text-center m-t-1">
                <div>{{ __('backend.signedInToControl') }} <a href="{{ url('/'.env('BACKEND_PATH').'/login') }}"
                                                              class="text-primary _600">{{ __('backend.signIn') }}</a>
                </div>
            </div>
        </div>

    </div>
@endsection
@else
    <script>
        window.location.href = '{{url("/login")}}';
    </script>
@endif

