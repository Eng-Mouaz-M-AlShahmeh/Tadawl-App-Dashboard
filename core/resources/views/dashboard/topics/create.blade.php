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
@section('title', $WebmasterSectionTitle)
@push("after-styles")
    <link href="{{ asset("assets/dashboard/js/iconpicker/fontawesome-iconpicker.min.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
@endpush
@section('content')
    <div class="padding">
        <div class="box">
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
                <h3><i class="material-icons">
                        &#xe02e;</i> {{ __('backend.topicNew') }} {!! $WebmasterSectionTitle !!}
                </h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a>{!! $WebmasterSectionTitle !!}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('topics',$WebmasterSection->id) }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['topicsStore',$WebmasterSection->id],'method'=>'POST', 'files' => true ])}}

                @if($WebmasterSection->date_status)
                    <div class="form-group row">
                        <label for="date"
                               class="col-sm-2 form-control-label">{!!  __('backend.topicDate') !!}
                        </label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }}',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                    {!! Form::text('date',Helper::formatDate(date("Y-m-d")), array('placeholder' => '','class' => 'form-control','id'=>'date','required'=>'')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    {!! Form::hidden('date',date("Y-m-d"), array('placeholder' => '','class' => 'form-control','id'=>'date')) !!}
                @endif

                @if($WebmasterSection->expire_date_status)
                    <div class="form-group row">
                        <label for="date"
                               class="col-sm-2 form-control-label">{!!  __('backend.expireDate') !!}
                        </label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }}',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                    {!! Form::text('expire_date','', array('placeholder' => '','class' => 'form-control','id'=>'expire_date')) !!}
                                    <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                @if($WebmasterSection->sections_status!=0)
                    <div class="form-group row">
                        <label for="section_id"
                               class="col-sm-2 form-control-label">{!!  __('backend.hasCategories') !!} </label>
                        <div class="col-sm-10">
                            <select name="section_id[]" id="section_id" class="form-control select2-multiple" multiple
                                    ui-jp="select2"
                                    ui-options="{theme: 'bootstrap'}" required>
                                <?php
                                $title_var = "title_" . @Helper::currentLanguage()->code;
                                $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                $t_arrow = "&raquo;";
                                ?>
                                @foreach ($fatherSections as $fatherSection)
                                    <?php
                                    if ($fatherSection->$title_var != "") {
                                        $ftitle = $fatherSection->$title_var;
                                    } else {
                                        $ftitle = $fatherSection->$title_var2;
                                    }
                                    ?>
                                    <option value="{{ $fatherSection->id  }}">{!! $ftitle !!}</option>
                                    @foreach ($fatherSection->fatherSections as $subFatherSection)
                                        <?php
                                        if ($subFatherSection->$title_var != "") {
                                            $title = $subFatherSection->$title_var;
                                        } else {
                                            $title = $subFatherSection->$title_var2;
                                        }
                                        ?>
                                        <option
                                            value="{{ $subFatherSection->id  }}">{!! $ftitle !!} {!! $t_arrow !!} {!! $title !!}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    {!! Form::hidden('section_id','0') !!}
                @endif

                @if($WebmasterSection->title_status)
                    @foreach(Helper::languagesList() as $ActiveLanguage)
                        @if($ActiveLanguage->box_status)
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 form-control-label">{!!  __('backend.topicName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                @if($WebmasterSection->longtext_status)

                    @if($WebmasterSection->editor_status)

                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 form-control-label">{!!  __('backend.bannerDetails') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="box p-a-xs">
                                            {!! Form::textarea('details_'.@$ActiveLanguage->code,'<div dir='.@$ActiveLanguage->direction.'><br></div>', array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control summernote_'.@$ActiveLanguage->code, 'dir'=>@$ActiveLanguage->direction,'ui-options'=>'{height: 300,callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable,"'.@$ActiveLanguage->code.'");
            }
        }}')) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            @if($ActiveLanguage->box_status)
                                <div class="form-group row">
                                    <label
                                        class="col-sm-2 form-control-label">{!!  __('backend.bannerDetails') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('details_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control', 'dir'=>@$ActiveLanguage->direction,'rows'=>'5')) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endif

                @if($WebmasterSection->type==2)
                    <div class="form-group row">
                        <label for="video_type"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoType') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','0',true, array('id' => 'video_type1','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="none";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="block";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType1') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','1',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("youtube_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("youtube_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType2') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','2',false, array('id' => 'video_type2','class'=>'has-value','onclick'=>'document.getElementById("vimeo_link_div").style.display="block";document.getElementById("embed_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("vimeo_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.bannerVideoType3') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('video_type','3',false, array('id' => 'video_type3','class'=>'has-value','onclick'=>'document.getElementById("embed_link_div").style.display="block";document.getElementById("vimeo_link_div").style.display="none";document.getElementById("youtube_link_div").style.display="none";document.getElementById("files_div").style.display="none";document.getElementById("embed_link").value=""')) !!}
                                    <i class="dark-white"></i>
                                    Embed
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="files_div">
                        <div class="form-group row">
                            <label for="video_file"
                                   class="col-sm-2 form-control-label">{!!  __('backend.topicVideo') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::file('video_file', array('class' => 'form-control','id'=>'video_file','accept'=>'*')) !!}
                            </div>
                        </div>

                        <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                            <div class="offset-sm-2 col-sm-10">
                                <small>
                                    <i class="material-icons">&#xe8fd;</i>
                                    {!!  __('backend.videoTypes') !!}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="youtube_link_div" style="display: none">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoUrl') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('youtube_link','', array('placeholder' => 'https://www.youtube.com/watch?v=JQs4QyKnYMQ','class' => 'form-control','id'=>'youtube_link', 'dir'=>'ltr')) !!}
                        </div>
                    </div>
                    <div class="form-group row" id="vimeo_link_div" style="display: none">
                        <label for="youtube_link"
                               class="col-sm-2 form-control-label">{!!  __('backend.bannerVideoUrl2') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('vimeo_link','', array('placeholder' => 'https://vimeo.com/131766159','class' => 'form-control','id'=>'vimeo_link', 'dir'=>'ltr')) !!}
                        </div>
                    </div>
                    <div class="form-group row" id="embed_link_div" style="display: none">
                        <label for="embed_link"
                               class="col-sm-2 form-control-label">Embed Code</label>
                        <div class="col-sm-10">
                            {!! Form::textarea('embed_link','', array('placeholder' => '','class' => 'form-control','id'=>'embed_link', 'dir'=>'ltr','rows'=>'3')) !!}
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->type==3)
                    <div class="form-group row">
                        <label for="audio_file"
                               class="col-sm-2 form-control-label">{!!  __('backend.topicAudio') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('audio_file', array('class' => 'form-control','id'=>'audio_file','accept'=>'audio/*')) !!}
                        </div>
                    </div>

                    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                        <div class="offset-sm-2 col-sm-10">
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!!  __('backend.audioTypes') !!}
                            </small>
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->photo_status)
                    <div class="form-group row">
                        <label for="photo_file"
                               class="col-sm-2 form-control-label">{!!  __('backend.topicPhoto') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('photo_file', array('class' => 'form-control','id'=>'photo_file','accept'=>'image/*')) !!}
                        </div>
                    </div>
                    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                        <div class="offset-sm-2 col-sm-10">
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!!  __('backend.imagesTypes') !!}
                            </small>
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->icon_status)
                    <div class="form-group row">
                        <label for="icon"
                               class="col-sm-2 form-control-label">{!!  __('backend.sectionIcon') !!}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::text('icon','', array('placeholder' => '','class' => 'form-control icp icp-auto','id'=>'icon', 'data-placement'=>'bottomRight')) !!}
                                <span class="input-group-addon"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if($WebmasterSection->attach_file_status)
                    <div class="form-group row">
                        <label for="attach_file"
                               class="col-sm-2 form-control-label">{!!  __('backend.topicAttach') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::file('attach_file', array('class' => 'form-control','id'=>'attach_file')) !!}
                        </div>
                    </div>
                    <div class="form-group row m-t-md" style="margin-top: 0 !important;">
                        <div class="offset-sm-2 col-sm-10">
                            <small>
                                <i class="material-icons">&#xe8fd;</i>
                                {!!  __('backend.attachTypes') !!}
                            </small>
                        </div>
                    </div>
                @endif


                {{--Additional Feilds--}}
                @if(count($WebmasterSection->customFields) >0)
                    <?php
                    $cf_title_var = "title_" . @Helper::currentLanguage()->code;
                    $cf_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                    ?>
                    @foreach($WebmasterSection->customFields as $customField)
                        <?php
                        // check permission
                        $add_permission_groups = [];
                        if ($customField->add_permission_groups != "") {
                            $add_permission_groups = explode(",", $customField->add_permission_groups);
                        }
                        if(in_array(Auth::user()->permissions_id, $add_permission_groups) || in_array(0, $add_permission_groups) || $customField->add_permission_groups == ""){
                        // have permission & continue
                        if ($customField->$cf_title_var != "") {
                            $cf_title = $customField->$cf_title_var;
                        } else {
                            $cf_title = $customField->$cf_title_var2;
                        }

                        // check field language status
                        $cf_land_identifier = "";
                        $cf_land_active = false;
                        $cf_land_dir = @Helper::currentLanguage()->direction;
                        if ($customField->lang_code != "all") {
                            $ct_language = @Helper::LangFromCode($customField->lang_code);
                            $cf_land_identifier = @Helper::languageName($ct_language);
                            $cf_land_dir = $ct_language->direction;
                            if ($ct_language->box_status) {
                                $cf_land_active = true;
                            }
                        }
                        if ($customField->lang_code == "all") {
                            $cf_land_active = true;
                        }
                        // required Status
                        $cf_required = "";
                        if ($customField->required) {
                            $cf_required = "required";
                        }
                        ?>

                        @if($cf_land_active)
                            @if($customField->type ==12)
                                {{--Vimeo Video Link--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!} <i class="fa fa-vimeo"></i>
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==11)
                                {{--Youtube Video Link--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!} <i class="fa fa-youtube"></i>
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>'ltr')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==10)
                                {{--Video File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==9)
                                {{--Attach File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==8)
                                {{--Photo File--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::file('customField_'.$customField->id, array('class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','accept'=>'image/*')) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==7)
                                {{--Multi Check--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        <select name="{{'customField_'.$customField->id}}[]"
                                                id="{{'customField_'.$customField->id}}"
                                                class="form-control select2-multiple" multiple
                                                ui-jp="select2"
                                                ui-options="{theme: 'bootstrap'}" {{$cf_required}}>
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
                                                <option
                                                    value="{{ $line_num  }}" {{ ($customField->default_value == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                                <?php
                                                $line_num++;
                                                ?>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @elseif($customField->type ==6)
                                {{--Select--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}</label>
                                    <div class="col-sm-10">
                                        <select name="{{'customField_'.$customField->id}}"
                                                id="{{'customField_'.$customField->id}}"
                                                class="form-control c-select" {{$cf_required}}>
                                            <option value="">- - {!!  $cf_title !!} - -</option>
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
                                                <option
                                                    value="{{ $line_num  }}" {{ ($customField->default_value == $line_num) ? "selected='selected'":""  }}>{{ $cf_details_line }}</option>
                                                <?php
                                                $line_num++;
                                                ?>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @elseif($customField->type ==5)
                                {{--Date & Time--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        <div>
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }} hh:mm A',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('customField_'.$customField->id,Helper::formatDate($customField->default_value)." ".date("h:i A", strtotime($customField->default_value)), array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($customField->type ==4)
                                {{--Date--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class='input-group date' ui-jp="datetimepicker" ui-options="{
                format: '{{ Helper::jsDateFormat() }}',
                icons: {
                  time: 'fa fa-clock-o',
                  date: 'fa fa-calendar',
                  up: 'fa fa-chevron-up',
                  down: 'fa fa-chevron-down',
                  previous: 'fa fa-chevron-left',
                  next: 'fa fa-chevron-right',
                  today: 'fa fa-screenshot',
                  clear: 'fa fa-trash',
                  close: 'fa fa-remove'
                }
              }">
                                                {!! Form::text('customField_'.$customField->id,Helper::formatDate($customField->default_value), array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                                <span class="input-group-addon">
                  <span class="fa fa-calendar"></span>
              </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @elseif($customField->type ==3)
                                {{--Email Address--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::email('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>

                            @elseif($customField->type ==2)
                                {{--Number--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::number('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'','min'=>0, 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>
                            @elseif($customField->type ==1)
                                {{--Text Area--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control',$cf_required=>'', 'dir'=>$cf_land_dir,'rows'=>'5')) !!}
                                    </div>
                                </div>
                            @else
                                {{--Text Box--}}
                                <div class="form-group row">
                                    <label for="{{'customField_'.$customField->id}}"
                                           class="col-sm-2 form-control-label">{!!  $cf_title !!}
                                        {!! $cf_land_identifier !!}
                                    </label>
                                    <div class="col-sm-10">
                                        {!! Form::text('customField_'.$customField->id,$customField->default_value, array('placeholder' => '','class' => 'form-control','id'=>'customField_'.$customField->id,$cf_required=>'', 'dir'=>$cf_land_dir)) !!}
                                    </div>
                                </div>
                            @endif
                        @endif
                        <?php
                        }
                        ?>
                    @endforeach
                @endif
                {{--End of -- Additional Feilds--}}

                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.add') !!}</button>
                        <a href="{{ route('topics',$WebmasterSection->id) }}"
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
    <script src="{{ asset("assets/dashboard/js/summernote/dist/summernote.js") }}"></script>
    <script>
        $(function () {
            $('.icp-auto').iconpicker({placement: '{{ (@Helper::currentLanguage()->direction=="rtl")?"topLeft":"topRight" }}'});
        });

        function sendFile(file, editor, welEditable, lang) {
            data = new FormData();
            data.append("file", file);
            data.append("_token", "{{csrf_token()}}");
            $.ajax({
                data: data,
                type: 'POST',
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
                    return myXhr;
                },
                url: "{{ route("topicsPhotosUpload") }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function (url) {
                    var image = $('<img>').attr('src', '{{ asset("uploads/topics/") }}/' + url);
                    @foreach(Helper::languagesList() as $ActiveLanguage)
                        @if($ActiveLanguage->box_status)
                    if (lang == "{{ $ActiveLanguage->code }}") {
                        $('.summernote_{{ $ActiveLanguage->code }}').summernote("insertNode", image[0]);
                    }
                    @endif
                    @endforeach
                }
            });
        }

        // update progress bar
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                $('progress').attr({value: e.loaded, max: e.total});
                // reset progress on complete
                if (e.loaded == e.total) {
                    $('progress').attr('value', '0.0');
                }
            }
        }
    </script>
@endpush
