@extends('dashboard.layouts.master')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . env('DEFAULT_LANGUAGE');
if ($WebmasterSection->$title_var != "") {
    $WebmasterSectionTitle = $WebmasterSection->$title_var;
} else {
    $WebmasterSectionTitle = $WebmasterSection->$title_var2;
}
?>
@section('title', $Topic->{"title_" . @Helper::currentLanguage()->code})
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endpush
@section('content')
    <div class="padding">
        <div class="box m-b-0">
            <div class="box-header dker">
                <?php
                $title_var = "title_" . @Helper::currentLanguage()->code;
                $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                if ($WebmasterSection->$title_var != "") {
                    $WebmasterSectionTitle = $WebmasterSection->$title_var;
                } else {
                    $WebmasterSectionTitle = $WebmasterSection->$title_var2;
                }
                ?>
                <h3>{!! $WebmasterSectionTitle !!}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="{{ route('topics',$WebmasterSection->id) }}">{!! $WebmasterSectionTitle !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    @if (@Auth::user()->permissionsGroup->edit_status)
                        <li class="nav-item inline">
                            <a href="{!! route("topicsEdit", ["webmasterId" => @$Topic->webmasterSection->id, "id" => $Topic->id]) !!}"
                               data-toggle="tooltip" data-original-title="{{ __('backend.edit') }}"
                               class="btn btn-sm white"><i
                                    class="material-icons">&#xe3c9;</i></a>
                        </li>
                    @endif
                    <li class="nav-item inline">
                        <a class="btn btn-sm white" href="{{ route('topics',$WebmasterSection->id) }}"
                           data-toggle="tooltip" data-original-title="{{ __('backend.close') }}">
                            <i class="material-icons">&#xe5cd;</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
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
        <div class="box">
            <div class="box-body" style="padding: 13px">

                <article>
                    @if($WebmasterSection->title_status)
                        <div class="post-heading">
                            <h3>
                                @if($Topic->icon !="")
                                    <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                @endif
                                {{ $title }}
                            </h3>
                        </div>
                    @endif
                    @if(count($Topic->photos)>0)
                        {{--photo slider--}}
                        <div class="post-slider">
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
                        @if($Topic->photo_file !="")
                            <div class="post-image">
                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                     alt="{{ $title }}" title="{{ $title }}"/>
                            </div>
                            <br>
                        @endif
                    @endif
                    @if($WebmasterSection->date_status)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row field-row">
                                    <div class="col-sm-2">
                                        <strong>{!! __("backend.topicDate")  !!} :</strong>
                                    </div>
                                    <div class="col-sm-10">
                                        {!! Helper::formatDate($Topic->date)  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($WebmasterSection->expire_date_status)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row field-row">
                                    <div class="col-sm-2">
                                        <strong>{!! __("backend.expireDate")  !!} :</strong>
                                    </div>
                                    <div class="col-sm-10">
                                        {!! Helper::formatDate($Topic->expire_date)  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--Additional Feilds--}}
                    @if(count($Topic->webmasterSection->customFields) >0)
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                $cf_title_var = "title_" . @Helper::currentLanguage()->code;
                                $cf_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                ?>
                                @foreach($Topic->webmasterSection->customFields as $customField)
                                    <?php
                                    // check permission
                                    $view_permission_groups = [];
                                    if ($customField->view_permission_groups != "") {
                                        $view_permission_groups = explode(",", $customField->view_permission_groups);
                                    }
                                    if (in_array(Auth::user()->permissions_id, $view_permission_groups) || in_array(0, $view_permission_groups) || $customField->view_permission_groups=="") {
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
                                                    <div class="row field-row {!! $customField->css_class !!}">
                                                        <div class="col-sm-2">
                                                            <strong>{!!  $cf_title !!} :</strong>
                                                        </div>
                                                        <div class="col-sm-10">
                                                            {{-- Vimeo Video --}}
                                                            <iframe allowfullscreen style="height:450px;width: 100%"
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
                                                    <div class="row field-row {!! $customField->css_class !!}">
                                                        <div class="col-sm-2">
                                                            <strong>{!!  $cf_title !!} :</strong>
                                                        </div>
                                                        <div class="col-sm-10">
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
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <video width="100%" height="450" controls>
                                                            <source src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                                    type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==9)
                                                {{--Attach File--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
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
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <img src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                                                             alt="{{ $cf_title }} - {{ $title }}"
                                                             title="{{ $cf_title }} - {{ $title }}">
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==7)
                                                {{--Multi Check--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
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
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
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
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!! Helper::formatDate($cf_saved_val)." ".date("h:i A", strtotime($cf_saved_val)) !!}
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==4)
                                                {{--Date--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!! Helper::formatDate($cf_saved_val) !!}
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==3)
                                                {{--Email Address--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!! $cf_saved_val !!}
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==2)
                                                {{--Number--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!! $cf_saved_val !!}
                                                    </div>
                                                </div>
                                            @elseif($customField->type ==1)
                                                {{--Text Area--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!! nl2br($cf_saved_val) !!}
                                                    </div>
                                                </div>
                                            @else
                                                {{--Text Box--}}
                                                <div class="row field-row {!! $customField->css_class !!}">
                                                    <div class="col-sm-2">
                                                        <strong>{!!  $cf_title !!} :</strong>
                                                    </div>
                                                    <div class="col-sm-10">
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
                        <br>
                    @endif
                    {{--End of -- Additional Feilds--}}


                    {!! $Topic->$details !!}
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

                    {{-- Show Additional attach files --}}
                    @if(count($Topic->attachFiles)>0)
                        <br>
                        <div class="row">
                            @foreach($Topic->attachFiles as $attachFile)
                                <?php
                                if ($attachFile->$title_var != "") {
                                    $file_title = $attachFile->$title_var;
                                } else {
                                    $file_title = $attachFile->$title_var2;
                                }
                                ?>
                                <div class="col-sm-3 text-center">
                                    <a href="{{ URL::to('uploads/topics/'.$attachFile->file) }}" target="_blank"
                                       style="padding: 10px;border: 1px dashed #ccc;margin-bottom: 10px;display: block;background: #f9f9f9">
                                        <strong>
                                            {!! Helper::GetIcon(URL::to('uploads/topics/'),$attachFile->file,40) !!}
                                            <br>
                                            &nbsp;{{ $file_title }}</strong>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if(count($Topic->maps) >0)
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <h4><i class="fa fa-map-marker"></i> {{ __('frontend.locationMap') }}</h4>
                                <div id="google-map"></div>
                            </div>
                        </div>
                    @endif

                    @if($WebmasterSection->related_status)
                        @if(count($Topic->relatedTopics))
                            <div id="Related">
                                <div class="row">
                                    <div class="col-sm-12">
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
        </div>


        @if($WebmasterSection->comments_status)
            <div class="box">
                <div class="box-header dker">
                    <h3><i class="fa fa-comments"></i> {{ __('frontend.comments') }}</h3>
                </div>
                <div class="box-body p-a">
                    <div id="comments">
                        @if(count($Topic->approvedComments)>0)
                            <div class="streamline b-l m-b m-l">

                                @foreach($Topic->approvedComments as $comment)
                                    <?php
                                    $dtformated = date('d M Y h:i A', strtotime($comment->date));
                                    ?>
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ URL::to('uploads/contacts/profile.jpg') }}" class="img-circle">
                                        </div>
                                        <div class="sl-content">
                                            <div class="sl-date text-muted">{{ $dtformated }}</div>
                                            <div class="sl-author">
                                                <strong>{{$comment->name}}</strong>
                                            </div>
                                            <div>
                                                <p>
                                                    {!! nl2br(strip_tags($comment->comment)) !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <h6><i class="fa fa-plus"></i> {{ __('frontend.newComment') }}</h6>
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
                                        {!! Form::hidden('comment_name',@Auth::user()->name, array('placeholder' => __('frontend.yourName'),'class' => 'form-control','id'=>'comment_name', 'data-msg'=> __('frontend.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                        <div class="alert alert-warning validation"></div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::hidden('comment_email',@Auth::user()->email, array('placeholder' => __('frontend.yourEmail'),'class' => 'form-control','id'=>'comment_email', 'data-msg'=> __('frontend.enterYourEmail'),'data-rule'=>'email')) !!}
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
                </div>
            </div>
        @endif



        @if($WebmasterSection->order_status)
            <div class="box">
                <div class="box-header dker">
                    <h3><i class="fa fa-cart-plus"></i> {{ __('frontend.orderForm') }}</h3>
                </div>
                <div class="box-body p-a">
                    <div id="order">
                        <div class="row">
                            <div class="col-sm-12">
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
                                        {!! Form::number('order_qty',"", array('placeholder' => __('frontend.quantity'),'class' => 'form-control','id'=>'order_qty', 'data-msg'=> __('frontend.yourQuantity'),'data-rule'=>'minlen:1','min'=>'1')) !!}
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
                </div>
            </div>
        @endif
    </div>
@endsection
@push("after-scripts")
    <script src="{{ URL::asset('assets/frontend/js/jquery.flexslider.js') }}"></script>
    <script>

        $('.p-slider').flexslider({
            // Primary Controls
            controlNav: false,              //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
            directionNav: true,              //Boolean: Create navigation for previous/next navigation? (true/false)
            prevText: "Previous",        //String: Set the text for the "previous" directionNav item
            nextText: "Next",            //String: Set the text for the "next" directionNav item

            // Secondary Navigation
            keyboard: true,              //Boolean: Allow slider navigating via keyboard left/right keys
            multipleKeyboard: false,             //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
            mousewheel: false,             //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
            pausePlay: false,             //Boolean: Create pause/play dynamic element
            pauseText: 'Pause',           //String: Set the text for the "pause" pausePlay item
            playText: 'Play',            //String: Set the text for the "play" pausePlay item

            // Special properties
            controlsContainer: "",                //{UPDATED} Selector: USE CLASS SELECTOR. Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be ".flexslider-container". Property is ignored if given element is not found.
            manualControls: "",                //Selector: Declare custom control navigation. Examples would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
            sync: "",                //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
            asNavFor: "",                //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
        });
    </script>
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
            var iconURLPrefix = "{{ URL::to('backEnd/assets/images/')."/" }}";
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
                $.ajax({
                    type: "POST",
                    url: "{{ route("commentSubmit") }}",
                    data: str,
                    success: function (msg) {
                        if (msg == 'OK') {
                            $("#sendmessage").addClass("show");
                            $("#errormessage").removeClass("show");
                            $("#comment_message").val('');
                        } else {
                            $("#sendmessage").removeClass("show");
                            $("#errormessage").addClass("show");
                            $('#errormessage').html(msg);
                        }

                    }
                });
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
                            $("#order_qty").val('');
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
@endpush
