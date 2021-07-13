<meta charset="utf-8">

<title>
    
    @if(Route::currentRouteName() == "ads.adsPage")
  {{$Ads->categoryAqar->name}} {{($Ads->categoryAqar->name !="")? "|":""}}
  @endif
  
    {{$PageTitle}} {{($PageTitle !="")? "|":""}} {{ Helper::GeneralSiteSettings("site_title_" . @Helper::currentLanguage()->code) }}

</title>

@if(Route::currentRouteName() == "ads.adsPage")
<meta name="description" content="{{$Ads->description->description}} | {!! @$Ads->description->price !!} ريال سعودي"/>
@else
<meta name="description" content="{{$PageDescription}}"/>
@endif

<meta name="keywords" content="{{$PageKeywords}}"/>
<meta name="author" content="{{ URL::to('') }}"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="{{ URL::asset('assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/frontend/css/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/frontend/css/jcarousel.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/frontend/css/flexslider.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/frontend/css/style.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/frontend/css/color.css') }}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/frontend/css/colors.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="{{ URL::asset('assets/frontend/js/owl-carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/frontend/js/owl-carousel/assets/owl.theme.default.min.css') }}">

@if( @Helper::currentLanguage()->direction=="rtl")
<link href="{{ URL::asset('assets/frontend/css/rtl.css') }}" rel="stylesheet"/>
@endif

<!-- Favicon and Touch Icons -->

@if(Route::currentRouteName() == "ads.adsPage")
<link href="https://tadawl.com.sa/API/assets/images/ads/{{ $Image->ads_image }}" rel="shortcut icon" type="image/png">
  
@elseif(Helper::GeneralSiteSettings("style_fav") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
          type="image/png">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
@endif

<!--
<link rel="stylesheet" href="{{ URL::asset('assets/frontend/js/jquerySlider/dist/jquery.flipster.min.css') }}">
-->


@if(Helper::GeneralSiteSettings("style_apple") !="")
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
          sizes="144x144">
@else
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
@endif

<meta property='og:title'
      content='{{$PageTitle}} {{($PageTitle =="")? Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')):""}}'/>
@if(@$Topic->photo_file !="")
    <meta property='og:image' content='{{ URL::asset('uploads/topics/'.@$Topic->photo_file) }}'/>
    
    
@elseif(Route::currentRouteName() == "ads.adsPage")
<meta property='og:image' content="https://tadawl.com.sa/API/assets/images/ads/{{ $Image->ads_image }}" />

@elseif(Helper::GeneralSiteSettings("style_apple") !="")
    <meta property='og:image'
          content='{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}'/>
@else
    <meta property='og:image'
          content='{{ URL::asset('uploads/settings/nofav.png') }}'/>
@endif
<meta property="og:site_name" content="{{ Helper::GeneralSiteSettings("site_title_" . trans('backLang.boxCode')) }}">


@if(Route::currentRouteName() == "ads.adsPage")
<meta property="og:description" content="{{$Ads->description->description}} | {!! @$Ads->description->price !!} ريال سعودي"/>
@else
<meta property="og:description" content="{{$PageDescription}}"/>
@endif


<meta property="og:url" content="{{ url()->full()  }}"/>
<meta property="og:type" content="website"/>

@if(Helper::GeneralSiteSettings("css")!="")
    <style type="text/css">
        {!! Helper::GeneralSiteSettings("css") !!}
    </style>
@endif
{{-- Google Tags and google analytics --}}
@if($WebmasterSettings->google_tags_status && $WebmasterSettings->google_tags_id !="")
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','{!! $WebmasterSettings->google_tags_id !!}');</script>
    <!-- End Google Tag Manager -->
@endif
