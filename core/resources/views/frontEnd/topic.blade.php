@extends('frontEnd.layout')

@section('content')
    <?php
    $title_var = "title_" . @Helper::currentLanguage()->code;
    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
    $details_var = "details_" . @Helper::currentLanguage()->code;
    $details_var2 = "details_" . env('DEFAULT_LANGUAGE');
    if ($Topic->$title_var != "") {
        $title = $Topic->$title_var;
    } else {
        $title = $Topic->$title_var2;
    }
    if ($Topic->$details_var != "") {
        $details = $details_var;
    } else {
        $details = $details_var2;
    }
    $section = "";
    try {
        if ($Topic->section->$title_var != "") {
            $section = $Topic->section->$title_var;
        } else {
            $section = $Topic->section->$title_var2;
        }
    } catch (Exception $e) {
        $section = "";
    }
    ?>
    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route("Home") }}"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>
                        </li>
                        @if($WebmasterSection->id != 1)
                            <?php
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            if (@$WebmasterSection->$title_var != "") {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var;
                            } else {
                                $WebmasterSectionTitle = @$WebmasterSection->$title_var2;
                            }
                            ?>
                            <li class="active">{!! $WebmasterSectionTitle !!}</li>
                        @else
                            <li class="active">{{ $title }}</li>
                        @endif
                        @if(!empty($CurrentCategory))
                            <?php
                            $title_var = "title_" . @Helper::currentLanguage()->code;
                            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                            if (@$CurrentCategory->$title_var != "") {
                                $CurrentCategoryTitle = @$CurrentCategory->$title_var;
                            } else {
                                $CurrentCategoryTitle = @$CurrentCategory->$title_var2;
                            }
                            ?>
                            <li class="active"><i
                                    class="icon-angle-right"></i>{{ $CurrentCategoryTitle }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-{{(count($Categories)>0)? "8":"12"}}">

                    <article>
                        @if($WebmasterSection->type==2 && $Topic->video_file!="")
                            {{--video--}}
                            <div class="post-video">
                                @if($WebmasterSection->title_status)
                                    <div class="post-heading">
                                        <h1>
                                            @if($Topic->icon !="")
                                                <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                            @endif
                                            {{ $title }}
                                        </h1>
                                    </div>
                                @endif
                                <div class="video-container">
                                    @if($Topic->video_type ==1)
                                        <?php
                                        $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                        ?>
                                        @if($Youtube_id !="")
                                            {{-- Youtube Video --}}
                                            <iframe allowfullscreen
                                                    src="https://www.youtube.com/embed/{{ $Youtube_id }}">
                                            </iframe>
                                        @endif
                                    @elseif($Topic->video_type ==2)
                                        <?php
                                        $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                        ?>
                                        @if($Vimeo_id !="")
                                            {{-- Vimeo Video --}}
                                            <iframe allowfullscreen
                                                    src="https://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                            </iframe>
                                        @endif

                                    @elseif($Topic->video_type ==3)
                                        @if($Topic->video_file !="")
                                            {{-- Embed Video --}}
                                            {!! $Topic->video_file !!}
                                        @endif

                                    @else
                                        <video width="100%" height="450" controls autoplay>
                                            <source src="{{ URL::to('uploads/topics/'.$Topic->video_file) }}"
                                                    type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif


                                </div>
                            </div>
                        @elseif($WebmasterSection->type==3 && $Topic->audio_file!="")
                            {{--audio--}}
                            <div class="post-video">
                                @if($WebmasterSection->title_status)
                                    <div class="post-heading">
                                        <h1>
                                            @if($Topic->icon !="")
                                                <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                            @endif
                                            {{ $title }}
                                        </h1>
                                    </div>
                                @endif
                                @if($Topic->photo_file !="")
                                    <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                         alt="{{ $title }}"/>
                                @endif
                                <div>
                                    <audio controls autoplay>
                                        <source src="{{ URL::to('uploads/topics/'.$Topic->audio_file) }}"
                                                type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>

                                </div>
                            </div>
                            <br>
                        @elseif(count($Topic->photos)>0)
                            {{--photo slider--}}
                            <div class="post-slider">
                                @if($WebmasterSection->title_status)
                                    <div class="post-heading">
                                        <h1>
                                            @if($Topic->icon !="")
                                                <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                            @endif
                                            {{ $title }}
                                        </h1>
                                    </div>
                            @endif
                            <!-- start flexslider -->
                                <div class="p-slider flexslider">
                                    <ul class="slides">
                                        @if($Topic->photo_file !="")
                                            <li>
                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                                     alt="{{ $title }}"/>
                                            </li>
                                        @endif
                                        @foreach($Topic->photos as $photo)
                                            <li>
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                     alt="{{ $photo->title  }}"/>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <!-- end flexslider -->
                            </div>
                            <br>

                        @else
                            {{--one photo--}}
                            <div class="post-image">
                                @if($WebmasterSection->title_status)
                                    <div class="post-heading">
                                        <h1>
                                            @if($Topic->icon !="")
                                                <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                            @endif
                                            {{ $title }}
                                        </h1>
                                    </div>
                                @endif
                                @if($Topic->photo_file !="")
                                    <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                         alt="{{ $title }}" title="{{ $title }}"/>
                                    <br>
                                @endif
                            </div>
                        @endif


                        {{--Additional Feilds--}}
                        @if(count($Topic->webmasterSection->customFields->where("in_page",true)) >0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <?php
                                        $cf_title_var = "title_" . @Helper::currentLanguage()->code;
                                        $cf_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                        ?>
                                        @foreach($Topic->webmasterSection->customFields->where("in_page",true) as $customField)
                                            <?php
                                            // check permission
                                            $view_permission_groups = [];
                                            if ($customField->view_permission_groups != "") {
                                                $view_permission_groups = explode(",", $customField->view_permission_groups);
                                            }
                                            if (in_array(0, $view_permission_groups) || $customField->view_permission_groups=="") {
                                            // have permission & continue
                                            ?>
                                            @if($customField->in_page)
                                                <?php
                                                if ($customField->$cf_title_var != "") {
                                                    $cf_title = $customField->$cf_title_var;
                                                } else {
                                                    $cf_title = $customField->$cf_title_var2;
                                                }

                                                $cf_saved_val = "";
                                                $cf_saved_val_array = array();
                                                if (count($Topic->fields) > 0) {
                                                    foreach ($Topic->fields as $t_field) {
                                                        if ($t_field->field_id == $customField->id) {
                                                            if ($customField->type == 7) {
                                                                // if multi check
                                                                $cf_saved_val_array = explode(", ", $t_field->field_value);
                                                            } else {
                                                                $cf_saved_val = $t_field->field_value;
                                                            }
                                                        }
                                                    }
                                                }

                                                ?>

                                                @if(($cf_saved_val!="" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == @Helper::currentLanguage()->code))
                                                    @if($customField->type ==12)
                                                        {{--Vimeo Video Link--}}
                                                        <?php
                                                        $CF_Vimeo_id = Helper::Get_vimeo_video_id($cf_saved_val);
                                                        ?>
                                                        @if($CF_Vimeo_id !="")
                                                            <div class="row field-row">
                                                                <div class="col-lg-3">
                                                                    {!!  $cf_title !!} :
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    {{-- Vimeo Video --}}
                                                                    <iframe allowfullscreen
                                                                            style="height:450px;width: 100%"
                                                                            src="https://player.vimeo.com/video/{{ $CF_Vimeo_id }}?title=0&amp;byline=0">
                                                                    </iframe>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif($customField->type ==11)
                                                        {{--Youtube Video Link--}}

                                                        <?php
                                                        $CF_Youtube_id = Helper::Get_youtube_video_id($cf_saved_val);
                                                        ?>
                                                        @if($CF_Youtube_id !="")
                                                            <div class="row field-row">
                                                                <div class="col-lg-3">
                                                                    {!!  $cf_title !!} :
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    {{-- Youtube Video --}}
                                                                    <iframe allowfullscreen
                                                                            style="height: 450px;width: 100%"
                                                                            src="https://www.youtube.com/embed/{{ $CF_Youtube_id }}">
                                                                    </iframe>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif($customField->type ==10)
                                                        {{--Video File--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <video width="100%" height="450" controls>
                                                                    <source
                                                                        src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==9)
                                                        {{--Attach File--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <a href="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                   target="_blank">
                                                                <span class="badge">
                                                                    {!! Helper::GetIcon(URL::to('uploads/topics/'),$cf_saved_val) !!}
                                                                    {!! $cf_saved_val !!}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==8)
                                                        {{--Photo File--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <img
                                                                    src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                    alt="{{ $cf_title }} - {{ $title }}"
                                                                    title="{{ $cf_title }} - {{ $title }}">
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==7)
                                                        {{--Multi Check--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <?php
                                                                $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                                                                $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                                                                if ($customField->$cf_details_var != "") {
                                                                    $cf_details = $customField->$cf_details_var;
                                                                } else {
                                                                    $cf_details = $customField->$cf_details_var2;
                                                                }
                                                                $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                                $line_num = 1;
                                                                ?>
                                                                @foreach ($cf_details_lines as $cf_details_line)
                                                                    @if (in_array($line_num,$cf_saved_val_array))
                                                                        <span class="badge">
                                                            {!! $cf_details_line !!}
                                                        </span>
                                                                    @endif
                                                                    <?php
                                                                    $line_num++;
                                                                    ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==6)
                                                        {{--Select--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <?php
                                                                $cf_details_var = "details_" . @Helper::currentLanguage()->code;
                                                                $cf_details_var2 = "details_en" . env('DEFAULT_LANGUAGE');
                                                                if ($customField->$cf_details_var != "") {
                                                                    $cf_details = $customField->$cf_details_var;
                                                                } else {
                                                                    $cf_details = $customField->$cf_details_var2;
                                                                }
                                                                $cf_details_lines = preg_split('/\r\n|[\r\n]/', $cf_details);
                                                                $line_num = 1;
                                                                ?>
                                                                @foreach ($cf_details_lines as $cf_details_line)
                                                                    @if ($line_num == $cf_saved_val)
                                                                        {!! $cf_details_line !!}
                                                                    @endif
                                                                    <?php
                                                                    $line_num++;
                                                                    ?>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==5)
                                                        {{--Date & Time--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! Helper::formatDate($cf_saved_val)." ".date("h:i A", strtotime($cf_saved_val)) !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==4)
                                                        {{--Date--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! Helper::formatDate($cf_saved_val) !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==3)
                                                        {{--Email Address--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==2)
                                                        {{--Number--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @elseif($customField->type ==1)
                                                        {{--Text Area--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! nl2br($cf_saved_val) !!}
                                                            </div>
                                                        </div>
                                                    @else
                                                        {{--Text Box--}}
                                                        <div class="row field-row">
                                                            <div class="col-lg-3">
                                                                {!!  $cf_title !!} :
                                                            </div>
                                                            <div class="col-lg-9">
                                                                {!! $cf_saved_val !!}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                            <?php
                                            }
                                            ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif
                        {{--End of -- Additional Feilds--}}


                        {!! nl2br($Topic->$details) !!}
                        
  <!--                      
                        @if($Topic->attach_file !="")
                            <?php
                            $file_ext = strrchr($Topic->attach_file, ".");
                            $file_ext = strtolower($file_ext);
                            ?>
                            <div class="bottom-article">
                                @if($file_ext ==".jpg"|| $file_ext ==".jpeg"|| $file_ext ==".png"|| $file_ext ==".gif")
                                    <div class="text-center">
                                        <img src="{{ URL::to('uploads/topics/'.$Topic->attach_file) }}"
                                             alt="{{ $title }}"/>
                                    </div>
                                @else
                                    <a href="{{ URL::to('uploads/topics/'.$Topic->attach_file) }}">
                                        <strong>
                                            {!! Helper::GetIcon(URL::to('uploads/topics/'),$Topic->attach_file) !!}
                                            &nbsp;{{ __('frontend.downloadAttach') }}</strong>
                                    </a>
                                @endif
                            </div>
                        @endif

-->


                        {{-- Show Additional attach files --}}
                        @if(count($Topic->attachFiles)>0)
                            <div style="padding: 10px;border: 1px dashed #ccc;margin-bottom: 10px;">
                                @foreach($Topic->attachFiles as $attachFile)
                                    <?php
                                    if ($attachFile->$title_var != "") {
                                        $file_title = $attachFile->$title_var;
                                    } else {
                                        $file_title = $attachFile->$title_var2;
                                    }
                                    ?>
                                    <div style="margin-bottom: 5px;">
                                        <a href="{{ URL::to('uploads/topics/'.$attachFile->file) }}" target="_blank">
                                            <strong>
                                                {!! Helper::GetIcon(URL::to('uploads/topics/'),$attachFile->file) !!}
                                                &nbsp;{{ $file_title }}</strong>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif


<!--
                        <div class="bottom-article">
                            <ul class="meta-post">
                                @if($WebmasterSection->date_status)
                                    <li><i class="fa fa-calendar"></i> <a>{!! Helper::formatDate($Topic->date)  !!}</a></li>
                                @endif
                                <li><i class="fa fa-eye"></i> <a>{{ __('frontend.visits') }}
                                        : {!! $Topic->visits !!}</a></li>
                                @if($WebmasterSection->comments_status)
                                    <li><i class="fa fa-comments"></i><a
                                            href="#comments">{{ __('frontend.comments') }}
                                            : {{count($Topic->approvedComments)}} </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="pull-right">
                                {{ __('frontend.share') }} :
                                <ul class="social-network share">
                                    <li><a href="{{ Helper::SocialShare("facebook", $PageTitle)}}" class="facebook"
                                           data-placement="top"
                                           title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ Helper::SocialShare("twitter", $PageTitle)}}" class="twitter"
                                           data-placement="top" title="Twitter"
                                           target="_blank"><i
                                                class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ Helper::SocialShare("google", $PageTitle)}}" class="google"
                                           data-placement="top"
                                           title="Google+"
                                           target="_blank"><i
                                                class="fa fa-google-plus"></i></a></li>
                                    <li><a href="{{ Helper::SocialShare("linkedin", $PageTitle)}}" class="linkedin"
                                           data-placement="top" title="linkedin"
                                           target="_blank"><i
                                                class="fa fa-linkedin"></i></a></li>
                                    <li><a href="{{ Helper::SocialShare("tumblr", $PageTitle)}}" class="tumblr'"
                                           data-placement="top" title="Tumblr"
                                           target="_blank"><i
                                                class="fa fa-tumblr"></i></a></li>
                                </ul>
                            </div>
                        </div>
-->


                        @if(count($Topic->maps) >0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <h4>{{ __('frontend.locationMap') }}</h4>
                                    <div id="google-map"></div>
                                </div>
                            </div>
                        @endif


                        @if($WebmasterSection->comments_status)
                            <div id="comments">
                                @if(count($Topic->approvedComments)>0)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <h4><i class="fa fa-comments"></i> {{ __('frontend.comments') }}</h4>
                                            <hr>
                                        </div>
                                    </div>
                                    @foreach($Topic->approvedComments as $comment)
                                        <?php
                                        $dtformated = date('d M Y h:i A', strtotime($comment->date));
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <img src="{{ URL::to('uploads/contacts/profile.jpg') }}" class="profile"
                                                     alt="{{$comment->name}}">
                                                <div class="pullquote-left">
                                                    <strong>{{$comment->name}}</strong>
                                                    <div>
                                                        <small>
                                                            <small>{{ $dtformated }}</small>
                                                        </small>
                                                    </div>
                                                    {!! nl2br(strip_tags($comment->comment)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h4><i class="fa fa-plus"></i> {{ __('frontend.newComment') }}</h4>
                                        <div class="bottom-article newcomment">
                                            <div id="sendmessage"><i class="fa fa-check-circle"></i>
                                                &nbsp;{{ __('frontend.youCommentSent') }} &nbsp; <a
                                                    href="{{url()->current()}}"><i
                                                        class="fa fa-refresh"></i> {{ __('frontend.refresh') }}
                                                </a>
                                            </div>
                                            <div id="errormessage">{{ __('frontend.youMessageNotSent') }}</div>

                                            {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'commentForm'])}}
                                            <div class="form-group">
                                                {!! Form::text('comment_name',@Auth::user()->name, array('placeholder' => __('frontend.yourName'),'class' => 'form-control','id'=>'comment_name', 'data-msg'=> __('frontend.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                                <div class="alert alert-warning validation"></div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::email('comment_email',@Auth::user()->email, array('placeholder' => __('frontend.yourEmail'),'class' => 'form-control','id'=>'comment_email', 'data-msg'=> __('frontend.enterYourEmail'),'data-rule'=>'email')) !!}
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::textarea('comment_message','', array('placeholder' => __('frontend.comment'),'class' => 'form-control','id'=>'comment_message','rows'=>'5', 'data-msg'=> __('frontend.enterYourComment'),'data-rule'=>'required')) !!}
                                                <div class="validation"></div>
                                            </div>

                                            @if(env('NOCAPTCHA_STATUS', false))
                                                <div class="form-group">
                                                    {!! NoCaptcha::renderJs(@Helper::currentLanguage()->code) !!}
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            @endif
                                            <div>
                                                <input type="hidden" name="topic_id" value="{{$Topic->id}}">
                                                <button type="submit"
                                                        class="btn btn-theme">{{ __('frontend.sendComment') }}</button>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($WebmasterSection->order_status)
                            <div id="order">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h4><i class="fa fa-cart-plus"></i> {{ __('frontend.orderForm') }}</h4>
                                        <div class="bottom-article newcomment">
                                            <div id="ordersendmessage"><i class="fa fa-check-circle"></i>
                                                &nbsp;{{ __('frontend.youOrderSent') }}
                                            </div>
                                            <div id="ordererrormessage">{{ __('frontend.youMessageNotSent') }}</div>

                                            {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'orderForm'])}}
                                            <div class="form-group">
                                                {!! Form::text('order_name',@Auth::user()->name, array('placeholder' => __('frontend.yourName'),'class' => 'form-control','id'=>'order_name', 'data-msg'=> __('frontend.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                                <div class="alert alert-warning validation"></div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::text('order_phone',"", array('placeholder' => __('frontend.phone'),'class' => 'form-control','id'=>'order_phone', 'data-msg'=> __('frontend.enterYourPhone'),'data-rule'=>'minlen:4')) !!}
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::email('order_email',@Auth::user()->email, array('placeholder' => __('frontend.yourEmail'),'class' => 'form-control','id'=>'order_email', 'data-msg'=> __('frontend.enterYourEmail'),'data-rule'=>'email')) !!}
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::textarea('order_message','', array('placeholder' => __('frontend.notes'),'class' => 'form-control','id'=>'order_message','rows'=>'5')) !!}
                                                <div class="validation"></div>
                                            </div>

                                            @if(env('NOCAPTCHA_STATUS', false))
                                                <div class="form-group">
                                                    {!! NoCaptcha::renderJs(@Helper::currentLanguage()->code) !!}
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            @endif
                                            <div>
                                                <input type="hidden" name="topic_id" value="{{$Topic->id}}">
                                                <button type="submit"
                                                        class="btn btn-theme">{{ __('frontend.sendOrder') }}</button>
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if($WebmasterSection->related_status)
                            @if(count($Topic->relatedTopics))
                                <div id="Related">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <br>
                                            <h4><i class="fa fa-bookmark"></i> {{ __('backend.relatedTopics') }}
                                            </h4>
                                            <div class="bottom-article newcomment">
                                                <?php
                                                $title_var = "title_" . @Helper::currentLanguage()->code;
                                                $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                                $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
                                                $slug_var2 = "seo_url_slug_" . env('DEFAULT_LANGUAGE');
                                                ?>
                                                @foreach($Topic->relatedTopics as $relatedTopic)
                                                    <?php


                                                    if ($relatedTopic->topic->$title_var != "") {
                                                        $relatedTopic_title = $relatedTopic->topic->$title_var;
                                                    } else {
                                                        $relatedTopic_title = $relatedTopic->topic->$title_var2;
                                                    }
                                                    ?>
                                                    <div style="margin-bottom: 5px;">
                                                        <a href="{{ Helper::topicURL($relatedTopic->topic->id) }}"><i
                                                                class="fa fa-bookmark-o"></i>&nbsp; {!! $relatedTopic_title !!}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </article>
                </div>
                @if(count($Categories) >0)
                    @include('frontEnd.includes.side')
                @endif
            </div>
        </div>
    </section>

@endsection
@section('footerInclude')
    @if(count($Topic->maps) >0)
        @foreach($Topic->maps->slice(0,1) as $map)
            <?php
            $MapCenter = $map->longitude . "," . $map->latitude;
            ?>
        @endforeach
        <?php
        $map_title_var = "title_" . @Helper::currentLanguage()->code;
        $map_details_var = "details_" . @Helper::currentLanguage()->code;
        ?>
        <script type="text/javascript"
                src="//maps.google.com/maps/api/js?key={{ env("GOOGLE_MAPS_KEY") }}"></script>

        <script type="text/javascript">
            // var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
            var iconURLPrefix = "{{ asset('assets/dashboard/images/')."/" }}";
            var icons = [
                iconURLPrefix + 'marker_0.png',
                iconURLPrefix + 'marker_1.png',
                iconURLPrefix + 'marker_2.png',
                iconURLPrefix + 'marker_3.png',
                iconURLPrefix + 'marker_4.png',
                iconURLPrefix + 'marker_5.png',
                iconURLPrefix + 'marker_6.png'
            ]

            var locations = [
                    @foreach($Topic->maps as $map)
                ['<?php echo "<strong>" . $map->$map_title_var . "</strong>" . "<br>" . $map->$map_details_var; ?>', <?php echo $map->longitude; ?>, <?php echo $map->latitude; ?>, <?php echo $map->id; ?>, <?php echo $map->icon; ?>],
                @endforeach
            ];

            var map = new google.maps.Map(document.getElementById('google-map'), {
                zoom: 6,
                draggable: false,
                scrollwheel: false,
                center: new google.maps.LatLng(<?php echo $MapCenter; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon: icons[locations[i][4]],
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        </script>
    @endif
    <script type="text/javascript">

        jQuery(document).ready(function ($) {
            "use strict";

            @if($WebmasterSection->comments_status)
            //Comment
            $('form.commentForm').submit(function () {

                var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                f.children('input').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'email':
                                if (!emailExp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'checked':
                                if (!i.attr('checked')) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'regexp':
                                exp = new RegExp(exp);
                                if (!exp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                f.children('textarea').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                if (ferror) return false;
                else var str = $(this).serialize();
                var xhr = $.ajax({
                    type: "POST",
                    url: "{{ route("commentSubmit") }}",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#sendmessage").addClass("show");
                            $("#errormessage").removeClass("show");
                            $("#comment_name").val('');
                            $("#comment_email").val('');
                            $("#comment_message").val('');
                        } else {
                            $("#sendmessage").removeClass("show");
                            $("#errormessage").addClass("show");
                            $('#errormessage').html(msg);
                        }

                    }
                });
                console.log(xhr);
                return false;
            });
            @endif

            @if($WebmasterSection->order_status)

            //Order
            $('form.orderForm').submit(function () {

                var f = $(this).find('.form-group'),
                    ferror = false,
                    emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

                f.children('input').each(function () { // run all inputs

                    var i = $(this); // current input
                    var rule = i.attr('data-rule');

                    if (rule !== undefined) {
                        var ierror = false; // error flag for current input
                        var pos = rule.indexOf(':', 0);
                        if (pos >= 0) {
                            var exp = rule.substr(pos + 1, rule.length);
                            rule = rule.substr(0, pos);
                        } else {
                            rule = rule.substr(pos + 1, rule.length);
                        }

                        switch (rule) {
                            case 'required':
                                if (i.val() === '') {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'minlen':
                                if (i.val().length < parseInt(exp)) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'email':
                                if (!emailExp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'checked':
                                if (!i.attr('checked')) {
                                    ferror = ierror = true;
                                }
                                break;

                            case 'regexp':
                                exp = new RegExp(exp);
                                if (!exp.test(i.val())) {
                                    ferror = ierror = true;
                                }
                                break;
                        }
                        i.next('.validation').html('<i class=\"fa fa-info\"></i> &nbsp;' + (ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show();
                        !ierror ? i.next('.validation').hide() : i.next('.validation').show();
                    }
                });
                if (ferror) return false;
                else var str = $(this).serialize();
                var xhr = $.ajax({
                    type: "POST",
                    url: "{{ route("orderSubmit") }}",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#ordersendmessage").addClass("show");
                            $("#ordererrormessage").removeClass("show");
                            $("#order_name").val('');
                            $("#order_phone").val('');
                            $("#order_email").val('');
                            $("#order_message").val('');
                        } else {
                            $("#ordersendmessage").removeClass("show");
                            $("#ordererrormessage").addClass("show");
                            $('#ordererrormessage').html(msg);
                        }

                    }
                });
                //console.log(xhr);
                return false;
            });

            @endif
        });
    </script>

@endsection
