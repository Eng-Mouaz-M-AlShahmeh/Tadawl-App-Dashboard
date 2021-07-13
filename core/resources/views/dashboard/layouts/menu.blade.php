<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
$mnu_title_var = "title_" . @Helper::currentLanguage()->code;
$mnu_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
                <img src="{{ asset('assets/dashboard/images/logo.png') }}" alt="Control">
                <span style="font-size: 15px;" class="hidden-folded inline">{{ __('backend.control') }}</span>
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ __('backend.main') }}</small>
                    </li>

                    <li>
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;</i>
                  </span>
                            <span class="nav-text">{{ __('backend.dashboard') }}</span>
                        </a>
                    </li>


                    @if(Helper::GeneralWebmasterSettings("analytics_status"))
                        @if(@Auth::user()->permissionsGroup->analytics_status)
                            <?php
                            $currentFolder = "analytics"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "ip"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "visitors"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2  || $PathCurrentFolder3==$currentFolder3) ? 'class=active' : '' }}>
                                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                    <span class="nav-icon">
                    <i class="material-icons">&#xe1b8;</i>
                  </span>
                                    <span class="nav-text">{{ __('backend.visitorsAnalytics') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <li>
                                        <a onclick="location.href='{{ route('analytics', 'date') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsBydate') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/country"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'country') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByCountry') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/city"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'city') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByCity') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/os"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'os') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByOperatingSystem') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/browser"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'browser') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByBrowser') }}</span>
                                        </a>
                                    </li>

                                    <?php
                                    $currentFolder = "analytics/referrer"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'referrer') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByReachWay') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/hostname"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'hostname') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByHostName') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "analytics/org"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('analytics', 'org') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByOrganization') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "visitors"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a onclick="location.href='{{ route('visitors') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsVisitorsHistory') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "ip"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('visitorsIP') }}">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsIPInquiry') }}</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("newsletter_status"))
                        @if(@Auth::user()->permissionsGroup->newsletter_status)
                            <?php
                            $currentFolder = "contacts"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('contacts') }}">
<span class="nav-icon">
<i class="material-icons">&#xe7ef;</i>
</span>
                                    <span class="nav-text">{{ __('backend.newsletter') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('webmails') }}">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe156;</i>
                  </span>
                                    <span class="nav-text">{{ __('backend.siteInbox') }}
                                        @if( Helper::webmailsNewCount() >0)
                                            <badge class="label warn m-l-xs">{{ Helper::webmailsNewCount() }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("calendar_status"))
                        @if(@Auth::user()->permissionsGroup->calendar_status)
                            <?php
                            $currentFolder = "calendar"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('calendar') }}" onclick="location.href='{{ route('calendar') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                                    <span class="nav-text">{{ __('backend.calendar') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ __('backend.appData') }}</small>
                    </li>

                    <?php
                    $data_sections_arr = explode(",", Auth::user()->permissionsGroup->data_sections);
                    ?>
                    @foreach($GeneralWebmasterSections as $GeneralWebmasterSection)
                        @if(in_array($GeneralWebmasterSection->id,$data_sections_arr))
                            <?php
                            if ($GeneralWebmasterSection->$mnu_title_var != "") {
                                $GeneralWebmasterSectionTitle = $GeneralWebmasterSection->$mnu_title_var;
                            } else {
                                $GeneralWebmasterSectionTitle = $GeneralWebmasterSection->$mnu_title_var2;
                            }

                            $LiIcon = "&#xe2c8;";
                            
                            if ($GeneralWebmasterSection->type == 16) {
                                $LiIcon = "&#xe7f4;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 15) {
                                $LiIcon = "&#xe54e;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 14) {
                                $LiIcon = "&#xe0c6;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 13) {
                                $LiIcon = "&#xe0b7;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 12) {
                                $LiIcon = "&#xe241;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 11) {
                                $LiIcon = "&#xe0af;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 10) {
                                $LiIcon = "&#xe7ef;";
                            }
                            
                            if ($GeneralWebmasterSection->type == 3) {
                                $LiIcon = "&#xe050;"; // sound icon
                            }
                            if ($GeneralWebmasterSection->type == 2) {
                                $LiIcon = "&#xe63a;"; // vedio icon
                            }
                            if ($GeneralWebmasterSection->type == 1) {
                                $LiIcon = "&#xe251;"; // pic icon
                            }
                            if ($GeneralWebmasterSection->type == 0) {
                                $LiIcon = "&#xe2c8;"; // folder icon
                            }
                            if ($GeneralWebmasterSection->id == 1) {
                                $LiIcon = "&#xe3e8;"; // scan icon
                            } 
                            if ($GeneralWebmasterSection->id == 7) {
                                $LiIcon = "&#xe02f;"; // chat icon
                            }
                            if ($GeneralWebmasterSection->id == 2) {
                                $LiIcon = "&#xe540;"; // cup icon
                            }
                            if ($GeneralWebmasterSection->id == 3) {
                                $LiIcon = "&#xe307;"; // stream icon
                            }
                            if ($GeneralWebmasterSection->id == 8) {
                                $LiIcon = "&#xe8f6;"; // gift icon
                            }

                            // get 9 char after root url to check if is "webmaster"
                            $is_webmaster = substr($urlAfterRoot, 0, 9);
                            ?>
                            @if($GeneralWebmasterSection->sections_status > 0 && @Auth::user()->permissionsGroup->view_status == 0)
                                <li {{ ($GeneralWebmasterSection->id == @$WebmasterSection->id && $is_webmaster != "webmaster") ? 'class=active' : '' }}>
                                    <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                        <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                    <ul class="nav-sub">
                                        @if($GeneralWebmasterSection->sections_status > 0)

                                            <?php
                                            $currentFolder = "categories"; // Put folder name here
                                            $PathCurrentFolder = substr($urlAfterRoot,
                                                (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));
                                            ?>
                                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                                <a href="{{ route('categories',$GeneralWebmasterSection->id) }}">
                                                    <span
                                                        class="nav-text">{{ __('backend.sectionsOf') }} {{ $GeneralWebmasterSectionTitle }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        <?php
                                        $currentFolder = "topics"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot,
                                            (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                            <a href="{{ route('topics',$GeneralWebmasterSection->id) }}">
                                                <span
                                                    class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            @else
                            
                         
                         <?php
                         $name = Route::currentRouteName();
                         ?>
                            
                            @if($GeneralWebmasterSection->id == 20)
                             <li {{ ($name == "appUsers") ? 'class=active' : '' }}>
                                    <a href="{{ route('appUsers') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                             
                             
                             
                             @elseif($GeneralWebmasterSection->id == 21)
                             <li {{ ($name == "appREOffices") ? 'class=active' : '' }}>
                                    <a href="{{ route('appREOffices') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                               
                               
                                 
                             @elseif($GeneralWebmasterSection->id == 22)
                             <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>
                                    <a href="{{ route('appUsers') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                                
                                  
                             @elseif($GeneralWebmasterSection->id == 23)
                             <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>
                                    <a href="{{ route('appUsers') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                                
                                  
                             @elseif($GeneralWebmasterSection->id == 24)
                             <li {{ ($name == "appContactUss") ? 'class=active' : '' }}>
                                    <a href="{{ route('appContactUss') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                                
                                  
                             @elseif($GeneralWebmasterSection->id == 25)
                             <li {{ ($name == "appCoupons") ? 'class=active' : '' }}>
                                    <a href="{{ route('appCoupons') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                                
                                  
                             @elseif($GeneralWebmasterSection->id == 26)
                             <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>
                                    <a href="{{ route('appUsers') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                                
                                
                                
                          @else      
                                
                                
                                
                                
                            {{--    
                                <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>
                                    <a href="{{ route('appUsers') }}">
                  <span class="nav-icon">
                    <i class="material-icons">{!! $LiIcon !!}</i>
                  </span>
                                        <span
                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>
                                    </a>
                                </li>
                               --}}
                               
                                @endif
                                
                                
                                
                                
                                
                            @endif
                        @endif
                    @endforeach



<!--
                    @if(Helper::GeneralWebmasterSettings("banners_status"))
                        @if(@Auth::user()->permissionsGroup->banners_status)
                            <?php
                            $currentFolder = "banners"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                <a href="{{ route('Banners') }}">
<span class="nav-icon">
<i class="material-icons">&#xe433;</i>
</span>
                                    <span class="nav-text">{{ __('backend.adsBanners') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    
-->                    
                    

                    @if(Helper::GeneralWebmasterSettings("settings_status"))
                        @if(@Auth::user()->permissionsGroup->settings_status)
                            <li class="nav-header hidden-folded">
                                <small class="text-muted">{{ __('backend.settings') }}</small>
                            </li>

                            <?php
                            $currentFolder = "settings"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "menus"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "users"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder2));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2 || $PathCurrentFolder3==$currentFolder3 ) ? 'class=active' : '' }}>
                                <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                    <span class="nav-icon">
<i class="material-icons">&#xe8b8;</i>
</span>
                                    <span class="nav-text">{{ __('backend.generalSiteSettings') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <?php
                                    $currentFolder = "settings"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('settings') }}"
                                           onclick="location.href='{{ route('settings') }}'">
                                            <span class="nav-text">{{ __('backend.generalSettings') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "menus"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('menus') }}">
                                            <span class="nav-text">{{ __('backend.siteMenus') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "users"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('users') }}">
                                            <span class="nav-text">{{ __('backend.usersPermissions') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif


                    @if(@Auth::user()->permissionsGroup->webmaster_status)
                        <?php
                        $currentFolder = "webmaster"; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                        ?>
                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                            <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                <span class="nav-icon">
<i class="material-icons">&#xe8be;</i>
</span>
                                <span class="nav-text">{{ __('backend.webmasterTools') }}</span>
                            </a>
                            <ul class="nav-sub">
                                <?php
                                $PathCurrentSubFolder = substr($urlAfterRoot, 0, (strlen($currentFolder) + 1));
                                ?>
                                <li {{ ($PathCurrentFolder==$PathCurrentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('webmasterSettings') }}"
                                       onclick="location.href='{{ route('webmasterSettings') }}'">
                                        <span class="nav-text">{{ __('backend.generalSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "sections"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterSections') }}">
                                        <span class="nav-text">{{ __('backend.siteSectionsSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "banners"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterBanners') }}">
                                        <span class="nav-text">{{ __('backend.adsBannersSettings') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
