@extends('dashboard.layouts.master')
@section('title', __('backend.adsBanners'))
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endpush
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.bannerEdit') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.adsBanners') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("Banners")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['BannersUpdate',$Banners->id],'method'=>'POST', 'files' => true])}}

                {!! Form::hidden('section_id',$Banners->section_id) !!}

                @foreach(Helper::languagesList() as $ActiveLanguage)
                    @if($ActiveLanguage->box_status)
                        <div class="form-group row">
                            <label
                                class="col-sm-2 form-control-label">{!!  __('backend.bannerTitle') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('title_'.@$ActiveLanguage->code,$Banners->{'title_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($WebmasterBanner->type==2)
                    <div class="form-group row">
                        <label for="video_type"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoType') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','0',($Banners->video_type==0) ? true : false, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType1') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','1',($Banners->video_type==1) ? true : false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="block";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType2') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','2',($Banners->video_type==2) ? true : false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="block";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType3') }}
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row" id="youtube_link_div"
                         style="display: {{ ($Banners->video_type==1) ? "block" : "none" }}">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoUrl') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('youtube_link',$Banners->youtube_link, array('placeholder' => 'https://www.youtube.com/watch?v=JQs4QyKnYMQ','class' => 'form-control','id'=>'youtube_link', 'dir'=>'ltr')) !!}
                        </div>
                    </div>

                    <div class="form-group row" id="vimeo_link_div"
                         style="display: {{ ($Banners->video_type==2) ? "block" : "none" }}">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoUrl2') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('vimeo_link',$Banners->youtube_link, array('placeholder' => 'https://vimeo.com/131766159','class' => 'form-control','id'=>'vimeo_link', 'dir'=>'ltr')) !!}
                        </div>
                    </div>
                @endif


                @if($WebmasterBanner->type!=0)
                    @if($WebmasterBanner->type==1)
                        <?php
                        $ttile = "bannerPhoto";
                        $file_name = "file_";
                        $file_allow = "image/*";
                        ?>
                    @else
                        <?php
                        $ttile = "topicVideo";
                        $file_name = "file2_";
                        $file_allow = "*'";
                        ?>
                    @endif
                    <div id="files_div" style="display: {{ ($Banners->video_type == 0) ? "block" : "none" }}">
                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 form-control-label">{!!  __('backend.'.$ttile) !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                    </label>
                                    <div class="col-sm-10">
                                        @if($Banners->{$file_name.$ActiveLanguage->code}!="")
                                            @if($WebmasterBanner->type==1)
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4 box p-a-xs">
                                                            <a target="_blank"
                                                               href="{{ asset('uploads/banners/'.$Banners->{$file_name.$ActiveLanguage->code}) }}"><img
                                                                    src="{{ asset('uploads/banners/'.$Banners->{$file_name.$ActiveLanguage->code}) }}"
                                                                    class="img-responsive">
                                                                {{ $Banners->{$file_name.$ActiveLanguage->code} }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <a target="_blank"
                                                   href="{{ asset('uploads/banners/'.$Banners->{$file_name.$ActiveLanguage->code}) }}">{!!  $Banners->{$file_name.$ActiveLanguage->code} !!}</a>
                                            @endif
                                        @endif
                                        {!! Form::file($file_name.$ActiveLanguage->code, array('class' => 'form-control','accept'=>$file_allow)) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="offset-sm-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    @if($WebmasterBanner->type==1)
                                        {!!  __('backend.imagesTypes') !!}
                                    @else
                                        {!!  __('backend.videoTypes') !!}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                @endif
                @if($WebmasterBanner->desc_status)
                    @foreach(Helper::languagesList() as $ActiveLanguage)
                        @if($ActiveLanguage->box_status)
                            <div class="form-group row">
                                <label for="details_ar"
                                       class="col-sm-2 form-control-label">{!!  __('backend.bannerDetails') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::textarea('details_'.@$ActiveLanguage->code,$Banners->{'details_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction,'rows'=>'3')) !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                @if($WebmasterBanner->link_status)
                    <div class="form-group row">
                        <label for="link_url"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerLinkUrl') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('link_url',$Banners->link_url, array('placeholder' => 'http://www.site.com','class' => 'form-control','id'=>'link_url', 'dir'=>'ltr')) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterBanner->type==0)
                    <div class="form-group row">
                        <label for="code"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerCode') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('code',$Banners->code, array('placeholder' => '','class' => 'form-control', 'dir'=>'ltr','rows'=>'3')) !!}
                        </div>
                    </div>
                @endif


                @if($WebmasterBanner->icon_status)
                    <div class="form-group row">
                        <label for="icon"
                               class="col-sm-2 form-control-label">{!!  __('backend.sectionIcon') !!}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::text('icon',$Banners->icon, array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','1',($Banners->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.active') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('status','0',($Banners->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.notActive') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{route("Banners")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@push("after-scripts")
    <script src="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.js") }}"></script>
    <script>
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (@Helper::currentLanguage()->direction=="rtl")?"topLeft":"topRight" }}'});
        });
    </script>
@endpush
