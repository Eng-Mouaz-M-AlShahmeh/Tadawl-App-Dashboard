@if (@Auth::check())
    @if(!Helper::GeneralSiteSettings("site_status"))
        <div class="text-center bg-warning">
            <div class="row m-b-0">
                <div class="h6">
                    {{__('backend.websiteClosedForVisitors')}}
                </div>
            </div>
        </div>
    @endif
@endif
<header>
    <div class="site-top">
        <div class="container">
            <div>
                <div class="pull-right">
                    
                   
                   <!-- 
                    @if(Helper::GeneralWebmasterSettings("dashboard_link_status"))
                        @if(Auth::check())
                            <div class="btn-group header-dropdown">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }} <i class="fa fa-angle-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                       href="{{ route("adminHome") }}"> <i
                                            class="fa fa-cog"></i> {{__('frontend.dashboard')}}</a>
                                    @if(Auth::user()->permissions ==0 || Auth::user()->permissions ==1)
                                        <a class="dropdown-item"
                                           href="{{ route('usersEdit',Auth::user()->id) }}"> <i
                                                class="fa fa-user"></i> {{ __('backend.profile') }}</a>
                                    @endif
                                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                                        @if(@Auth::user()->permissionsGroup->inbox_status)
                                            <a href="{{ route('webmails') }}" class="dropdown-item">
                                                <i class="fa fa-envelope"></i> {{ __('backend.siteInbox') }}
                                            </a>
                                        @endif
                                    @endif
                                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                       class="dropdown-item" href="{{ url('/logout') }}"><i
                                            class="fa fa-sign-out"></i> {{ __('backend.logout') }}</a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        @else
                            <strong>
                                <a href="{{ route("adminHome") }}"><i
                                        class="fa fa-cog"></i> {{__('frontend.dashboard')}}
                                </a>
                            </strong>
                        @endif
                    @endif
                    -->
                    
                    
                    @if(count(Helper::languagesList()) >1)
                        <div class="btn-group header-dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                @if(@Helper::currentLanguage()->icon !="")
                                    <img
                                        src="{{ asset('assets/dashboard/images/flags/'.@Helper::currentLanguage()->icon.".svg") }}"
                                        alt="">
                                @endif
                                {{ @Helper::currentLanguage()->title }} <i class="fa fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                @foreach(Helper::languagesList() as $ActiveLanguage)
                                    <a href="{{ URL::to('lang/'.$ActiveLanguage->code) }}" class="dropdown-item">
                                        @if($ActiveLanguage->icon !="")
                                            <img
                                                src="{{ asset('assets/dashboard/images/flags/'.$ActiveLanguage->icon.".svg") }}"
                                                alt="">
                                        @endif
                                        {{ $ActiveLanguage->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="pull-left">
                    @if(Helper::GeneralSiteSettings("contact_t3") !="")
                        <i class="fa fa-phone"></i> &nbsp;<a
                            href="tel:{{ Helper::GeneralSiteSettings("contact_t5") }}"><span
                                dir="ltr">{{ Helper::GeneralSiteSettings("contact_t5") }}</span></a>
                    @endif
                    @if(Helper::GeneralSiteSettings("contact_t6") !="")
                        <span class="top-email">
                        &nbsp; | &nbsp;
                    <i class="fa fa-envelope"></i> &nbsp;<a
                                href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route("Home") }}">
                    @if(Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code) !="")
                        <img alt=""
                             src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("style_logo_" . @Helper::currentLanguage()->code)) }}">
                    @else
                        <img width="75px" hieght="75px" alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                    @endif

                </a>
            </div>
            
            
            <div class="navbar-header">
<a style="margin: 45px; font-size: 15px" class="btn btn-warning" href="#">
      {{__('backend.addAds')}}
</a>
</div>


            @include('frontEnd.includes.menu')
        </div>
    </div>
</header>
