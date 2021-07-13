<?php
$footer_style = "";
if (Helper::GeneralSiteSettings("style_footer_bg") != "") {
    $bg_file = URL::to('uploads/settings/' . Helper::GeneralSiteSettings("style_footer_bg"));
    $bg_color = Helper::GeneralSiteSettings("style_color1");
    $footer_style = "style='background: $bg_color url($bg_file) repeat-x center top'";
}
if (Helper::GeneralSiteSettings("style_footer") != 1) {
    $footer_style = "style=padding:0";
}
?>
<footer {!!  $footer_style !!}>
    @if(Helper::GeneralSiteSettings("style_footer")==1)
        <?php
        $bx1w = 3;
        $bx2w = 3;
        $bx3w = 3;
        $bx4w = 3;
        if (count($LatestNews) == 0 && Helper::GeneralSiteSettings("style_subscribe") == 0) {
            $bx1w = 6;
            $bx2w = 6;
            $bx3w = 6;
            $bx4w = 6;
        } elseif (count($LatestNews) == 0 || Helper::GeneralSiteSettings("style_subscribe") == 0) {
            $bx1w = 4;
            $bx2w = 4;
            $bx3w = 4;
            $bx4w = 4;
        }

        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-{{$bx1w}}">
                    <div class="widget contacts">
                        <h4 class="widgetheading"><i
                                class="fa fa-phone-square"></i>&nbsp; {{ __('frontend.contactDetails') }}</h4>
                        @if(Helper::GeneralSiteSettings("contact_t1_" . @Helper::currentLanguage()->code) !="")
                            <address>
                                <strong>{{ __('frontend.address') }}:</strong><br>
                                <i class="fa fa-map-marker"></i>
                                &nbsp;{{ Helper::GeneralSiteSettings("contact_t1_" . @Helper::currentLanguage()->code) }}
                            </address>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t3") !="")
                            <p>
                                <strong>{{ __('frontend.callUs') }}:</strong><br>
                                <i class="fa fa-phone"></i> &nbsp;<a
                                    href="tel:{{ Helper::GeneralSiteSettings("contact_t3") }}"><span
                                        dir="ltr">{{ Helper::GeneralSiteSettings("contact_t3") }}</span></a></p>
                        @endif
                        @if(Helper::GeneralSiteSettings("contact_t6") !="")
                            <p>
                                <strong>{{ __('frontend.email') }}:</strong><br>
                                <i class="fa fa-envelope"></i> &nbsp;<a
                                    href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                            </p>
                        @endif
                    </div>
                </div>
                @if(count($LatestNews)>0)
                    <?php
                    $footer_title_var = "title_" . @Helper::currentLanguage()->code;
                    $footer_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                    $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
                    $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
                    ?>
                    <div class="col-lg-{{$bx2w}}">
                        <div class="widget">
                            <h4 class="widgetheading"><i
                                    class="fa fa-rss"></i>&nbsp; {{ __('frontend.latestNews') }}
                            </h4>
                            <ul class="link-list">
                                @foreach($LatestNews as $LatestNew)
                                    <?php
                                    if ($LatestNew->$footer_title_var != "") {
                                        $LatestNew_title = $LatestNew->$footer_title_var;
                                    } else {
                                        $LatestNew_title = $LatestNew->$footer_title_var2;
                                    }
                                    ?>
                                    <li>
                                        <a href="{{ Helper::topicURL($LatestNew->id) }}">{{ $LatestNew_title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if(Helper::GeneralWebmasterSettings("footer_menu_id") >0)
                    <?php
                    // Get list of footer menu links by group Id
                    $FooterMenuLinks = Helper::MenuList(Helper::GeneralWebmasterSettings("footer_menu_id"));
                    ?>
                    @if(count($FooterMenuLinks)>0)
                        <div class="col-lg-{{$bx3w}}">
                            <div class="widget">
                                <?php
                                $link_title_var = "title_" . @Helper::currentLanguage()->code;
                                $link_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
                                $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
                                ?>
                                <h4 class="widgetheading"><i
                                        class="fa fa-bookmark"></i>&nbsp; {{  __('frontend.quickLinks') }}</h4>
                                <ul class="link-list">
                                    @foreach($FooterMenuLinks as $FooterMenuLink)
                                        <?php
                                        if ($FooterMenuLink->$link_title_var != "") {
                                            $link_title = $FooterMenuLink->$link_title_var;
                                        } else {
                                            $link_title = $FooterMenuLink->$link_title_var2;
                                        }
                                        ?>
                                        @if($FooterMenuLink->type==3 || $FooterMenuLink->type==2)
                                            {{-- Get Section Name as a link --}}
                                            <li>
                                                <a href="{{ Helper::sectionURL($FooterMenuLink->cat_id) }}">{{ $link_title }}</a>
                                            </li>
                                        @elseif($FooterMenuLink->type==1)
                                            {{-- Direct link --}}
                                            <?php
                                            if (@Helper::currentLanguage()->code != env('DEFAULT_LANGUAGE')) {
                                                $f3c = mb_substr($FooterMenuLink->link, 0, 3);
                                                if ($f3c == "htt" || $f3c == "www") {
                                                    $this_link_url = $FooterMenuLink->link;
                                                } else {
                                                    $this_link_url = url(@Helper::currentLanguage()->code . "/" . $FooterMenuLink->link);
                                                }
                                            } else {
                                                $this_link_url = url($FooterMenuLink->link);
                                            }
                                            ?>
                                            <li>
                                                <a href="{{ $this_link_url }}">{{ $link_title }}</a>
                                            </li>
                                        @else
                                            {{-- No link --}}
                                            <li><a>{{ $link_title }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
                @include('frontEnd.includes.subscribe')

            </div>
        </div>
    @endif
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">
                        <?php
                        $site_title_var = "site_title_" . @Helper::currentLanguage()->code;
                        ?>
                        &copy; <?php echo date("Y") ?> {{ __('frontend.AllRightsReserved') }}
                        . <a>{{$WebsiteSettings->$site_title_var}}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network">
                        @if($WebsiteSettings->social_link1)
                            <li><a href="{{$WebsiteSettings->social_link1}}" data-placement="top" title="Facebook"
                                   target="_blank"><i
                                        class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link2)
                            <li><a href="{{$WebsiteSettings->social_link2}}" data-placement="top" title="Twitter"
                                   target="_blank"><i
                                        class="fa fa-twitter"></i></a></li>
                        @endif
                        
                        <!--
                        @if($WebsiteSettings->social_link3)
                            <li><a href="{{$WebsiteSettings->social_link3}}" data-placement="top" title="Google+"
                                   target="_blank"><i
                                        class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link4)
                            <li><a href="{{$WebsiteSettings->social_link4}}" data-placement="top" title="linkedin"
                                   target="_blank"><i
                                        class="fa fa-linkedin"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link5)
                            <li><a href="{{$WebsiteSettings->social_link5}}" data-placement="top" title="Youtube"
                                   target="_blank"><i
                                        class="fa fa-youtube-play"></i></a></li>
                        @endif
                        -->
                        
                        @if($WebsiteSettings->social_link6)
                            <li><a href="{{$WebsiteSettings->social_link6}}" data-placement="top" title="Instagram"
                                   target="_blank"><i
                                        class="fa fa-instagram"></i></a></li>
                        @endif
                        
                        <!--
                        @if($WebsiteSettings->social_link7)
                            <li><a href="{{$WebsiteSettings->social_link7}}" data-placement="top" title="Pinterest"
                                   target="_blank"><i
                                        class="fa fa-pinterest"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link8)
                            <li><a href="{{$WebsiteSettings->social_link8}}" data-placement="top" title="Tumblr"
                                   target="_blank"><i
                                        class="fa fa-tumblr"></i></a></li>
                        @endif
                        -->
                        
                        @if($WebsiteSettings->social_link9)
                            <li><a href="{{$WebsiteSettings->social_link9}}" data-placement="top" title="Snapchat"
                                   target="_blank"><i
                                        class="fa fa-snapchat"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link10)
                            <li><a href="https://api.whatsapp.com/send?phone={{$WebsiteSettings->social_link10}}"
                                   data-placement="top"
                                   title="Whatsapp" target="_blank"><i
                                        class="fa fa-whatsapp"></i></a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
