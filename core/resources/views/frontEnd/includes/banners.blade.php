@if(!empty(@$BannersSettingsId))
    <?php
    // Get banners list array by settings ID (You can get settings ID from Webmaster >> Banners settings)
    $BannersList = Helper::BannersList($BannersSettingsId);
    ?>
    @if(count($BannersList)>0)
        <div class="widget">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Slider -->
                    <?php
                    $SideBanner_type = 0;
                    ?>
                    @foreach($BannersList->slice(0,1) as $SideBanner)
                        <?php
                        try {
                            $SideBanner_type = $SideBanner->webmasterBanner->type;
                        } catch (Exception $e) {
                            $SideBanner_type = 0;
                        }
                        ?>
                    @endforeach
                    <?php
                    $title_var = "title_" . @Helper::currentLanguage()->code;
                    $details_var = "details_" . @Helper::currentLanguage()->code;
                    $file_var = "file_" . @Helper::currentLanguage()->code;
                    ?>
                    @if($SideBanner_type==0)
                        {{-- Text/Code Banners--}}
                        <div class="text-center">
                            @foreach($BannersList as $SideBanner)
                                @if($SideBanner->code !="")
                                    <div>{!! $SideBanner->code !!}</div>
                                @endif
                                @if($SideBanner->$details_var !="")
                                    <div>{!! $SideBanner->$details_var !!}</div>
                                @endif
                            @endforeach
                        </div>
                    @elseif($SideBanner_type==1)
                        {{-- Photo Slider Banners--}}
                        <div class="text-center">
                            @foreach($BannersList as $SideBanner)
                                <div>
                                    @if($SideBanner->link_url !="")
                                        <a href="{!! $SideBanner->link_url !!}">
                                            @endif
                                            @if($SideBanner->$file_var !="")
                                                <img src="{{ URL::to('uploads/banners/'.$SideBanner->$file_var) }}"
                                                     alt="{{ $SideBanner->$title_var }}"/>
                                            @endif
                                            @if($SideBanner->link_url !="")
                                        </a>
                                    @endif
                                    @if($SideBanner->$details_var !="")
                                        <p>{!! nl2br($SideBanner->$details_var) !!}</p>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Video Banners--}}
                        <div class="text-center">
                            @foreach($BannersList as $SideBanner)
                                @if($SideBanner->youtube_link !="")
                                    @if($SideBanner->video_type ==1)
                                        <?php
                                        $Youtube_id = Helper::Get_youtube_video_id($SideBanner->youtube_link);
                                        ?>
                                        @if($Youtube_id !="")
                                            {{-- Youtube Video --}}
                                            <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                                    src="https://www.youtube.com/embed/{{ $Youtube_id }}">
                                            </iframe>
                                        @endif
                                    @elseif($SideBanner->video_type ==2)
                                        <?php
                                        $Vimeo_id = Helper::Get_vimeo_video_id($SideBanner->youtube_link);
                                        ?>
                                        @if($Vimeo_id !="")
                                            {{-- Vimeo Video --}}
                                            <iframe width="100%" height="500" frameborder="0" allowfullscreen
                                                    src="https://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                            </iframe>
                                        @endif
                                    @endif
                                @endif
                                @if($SideBanner->video_type ==0)
                                    @if($SideBanner->$file_var !="")
                                        {{-- Direct Video --}}
                                        <video width="100%" height="500" controls>
                                            <source src="{{ URL::to('uploads/banners/'.$SideBanner->$file_var) }}"
                                                    type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                @endif
                                @if($SideBanner->$details_var !="")
                                    <div>{!! $SideBanner->$details_var !!}</div>
                                @endif
                            @endforeach
                        </div>
                @endif
                <!-- end slider -->
                </div>
            </div>
        </div>
    @endif
@endif
