@if($group_id=="draft" || $cat_id ==2)
    <div>
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">
                        &#xe02e;</i> {{ __('backend.compose') }}
                </h3>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{ route('webmails') }}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['webmailsUpdate',"id"=>Session::get('WebmailToEdit')->id],'method'=>'POST', 'files' => true])}}
                <?php
                $siteTitle_var = "site_title_" . @Helper::currentLanguage()->code;
                $siteTitle_var2 = "site_title_" . env('DEFAULT_LANGUAGE');
                if ($SiteSetting->$siteTitle_var != "") {
                    $siteTitle = $SiteSetting->$siteTitle_var;
                } else {
                    $siteTitle = $SiteSetting->$siteTitle_var2;
                }
                try {
                    $from_email = Session::get('WebmailToEdit')->from_email;
                    $msg_title = Session::get('WebmailToEdit')->title;
                    $msg_details = Session::get('WebmailToEdit')->details;
                    $to_cc = Session::get('WebmailToEdit')->to_cc;
                    $to_bcc = Session::get('WebmailToEdit')->to_bcc;
                } catch (Exception $e) {
                    $from_email = "";
                    $msg_title = "";
                    $msg_details = "";
                    $to_cc = "";
                    $to_bcc = "";
                }
                ?>
                {!! Form::hidden('contact_id','') !!}
                {!! Form::hidden('father_id','') !!}
                {!! Form::hidden('from_email',env("MAIL_FROM_ADDRESS","email@site.com")) !!}
                {!! Form::hidden('from_name',$siteTitle) !!}
                {!! Form::hidden('from_phone','') !!}
                {!! Form::hidden('to_name','') !!}

                <div class="form-group row">
                    <label for="title_en"
                           class="col-sm-2 form-control-label">{!!  __('backend.sendTo') !!}
                    </label>
                    <div class="col-sm-9">
                        {!! Form::email('to_email',$from_email, array('placeholder' => '','class' => 'form-control','id'=>'to_email','required'=>'')) !!}
                    </div>
                    <div class="col-sm-1">
                        <small>
                            <a onclick="document.getElementById('cc').style.display='block'">{!!  __('backend.sendCc') !!}</a><br>
                            <a onclick="document.getElementById('bcc').style.display='block'">{!!  __('backend.sendBcc') !!}</a>
                        </small>
                    </div>
                </div>

                <?php
                $cc = "display: none";
                $bcc = "display: none";
                if ($to_cc !== "") {
                    $cc = "";
                    $bcc = "";
                }
                ?>
                <div id="cc" style="<?php echo $cc;?>" class="form-group row">
                    <label for="title_en"
                           class="col-sm-2 form-control-label">{!!  __('backend.sendCc') !!}
                    </label>
                    <div class="col-sm-9">
                        {!! Form::email('to_cc',$to_cc, array('placeholder' => '','class' => 'form-control','id'=>'to_cc')) !!}
                    </div>
                    <div class="col-sm-1">
                        <a onclick="document.getElementById('to_cc').value='';document.getElementById('cc').style.display='none'"><i
                                class="material-icons md-18">×</i></a>
                    </div>
                </div>
                <div id="bcc" style="<?php echo $bcc;?>" class="form-group row">
                    <label for="title_en"
                           class="col-sm-2 form-control-label">{!!  __('backend.sendBcc') !!}
                    </label>
                    <div class="col-sm-9">
                        {!! Form::email('to_bcc',$to_bcc, array('placeholder' => '','class' => 'form-control','id'=>'to_bcc')) !!}
                    </div>
                    <div class="col-sm-1">
                        <a onclick="document.getElementById('to_bcc').value='';document.getElementById('bcc').style.display='none'"><i
                                class="material-icons md-18">×</i></a>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title_en"
                           class="col-sm-2 form-control-label">{!!  __('backend.sendTitle') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('title',$msg_title, array('placeholder' => '','class' => 'form-control','id'=>'title','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="box p-a-xs">
                            {!! Form::textarea('details',$msg_details, array('ui-jp'=>'summernote','placeholder' => '','class' => 'form-control','ui-options'=>'{height: 250}')) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="attach_files"
                           class="col-sm-2 form-control-label">{!!  __('backend.AttachFiles') !!}</label>
                    <div class="col-sm-10">
                        {!! Form::file('attach_files[]', array('class' => 'form-control','id'=>'attach_files','multiple'=>'')) !!}
                    </div>
                </div>


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        {!! Form::hidden('btn_clicked','', array('id'=>'btn_clicked')) !!}
                        <button type="submit" name="btn_send" onclick="document.getElementById('btn_clicked').value=''"  class="btn btn-primary m-t"><i
                                class="material-icons">
                                &#xe31b;</i> {!! __('backend.send') !!}</button>
                        <button type="submit" name="btn_draft" onclick="document.getElementById('btn_clicked').value='draft'" class="btn btn-default m-t"><i
                                class="material-icons">
                                &#xe161;</i> {!! __('backend.SaveToDraft') !!}</button>
                        <a href="{{ route('webmails') }}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>

@else
    <div class="row hidden-print">
        <div class="col-sm-12">
            <div class="p-b-1 pull-right">
                <a href="{{ route("webmails",["group_id"=>"create","stat"=>"replay","wid"=>Session::get('WebmailToEdit')->id]) }}"
                   class="btn btn-sm success p-r-1"><i
                        class="fa fa-mail-reply"></i> {!! __('backend.replay') !!}</a>

                <a href="{{ route("webmails",["group_id"=>"create","stat"=>"forward","wid"=>Session::get('WebmailToEdit')->id]) }}"
                   class="btn btn-sm btn-info p-r-1 "><i
                        class="fa fa-mail-forward"></i> {!! __('backend.forward') !!}</a>

                <a class="btn btn-sm btn-default p-r-1"
                   onClick="window.print();"><i
                        class="fa fa-print"></i> {!! __('backend.print') !!}
                </a>
            </div>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="box p-a dark" style="min-height: 110px">
                <strong class="text-muted">{!! __('backend.sendFrom') !!}:
                    &nbsp; {!! Session::get('WebmailToEdit')->from_name !!}</strong>
                <p class="text-muted">
                    @if(Session::get('WebmailToEdit')->from_phone !="")
                        {!! __('backend.contactPhone') !!}:
                        &nbsp; {!! Session::get('WebmailToEdit')->from_phone !!}<br>
                    @endif
                    @if(Session::get('WebmailToEdit')->from_email !="")
                        {!! __('backend.contactEmail') !!}:
                        &nbsp; {!! Session::get('WebmailToEdit')->from_email !!}
                    @endif
                </p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box p-a" style="min-height: 110px">
                <strong class="text-muted">{!! __('backend.sendTo') !!}:
                    &nbsp; {!! Session::get('WebmailToEdit')->to_name !!}</strong>
                <p class="text-muted">
                    @if(Session::get('WebmailToEdit')->to_email !="")
                        {!! __('backend.contactEmail') !!}:
                        &nbsp; {!! Session::get('WebmailToEdit')->to_email !!}<br>

                    @endif
                    @if(Session::get('WebmailToEdit')->to_cc !="")
                        {!! __('backend.sendCc') !!}:
                        &nbsp; {!! Session::get('WebmailToEdit')->to_cc !!}<br>
                    @endif
                    @if(Session::get('WebmailToEdit')->to_bcc !="")
                        {!! __('backend.sendBcc') !!}:
                        &nbsp; {!! Session::get('WebmailToEdit')->to_bcc !!}
                    @endif

                </p>
            </div>
        </div>
    </div>
    <?php

    $dtformated = date('d M Y h:i A', strtotime(Session::get('WebmailToEdit')->date));

    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box p-a">
                <h4>{!! Session::get('WebmailToEdit')->title !!}</h4>
                <small><i class="fa fa-calendar"></i> {{$dtformated}}</small>
                @if(Session::get('WebmailToEdit')->details)
                    <hr>
                    <p></p>
                    {!! nl2br(Session::get('WebmailToEdit')->details) !!}
                    </p>
                @endif

            </div>
        </div>
    </div>
    @if(count(Session::get('WebmailToEdit')->files) > 0)
        <div class="row">
            <div class="col-sm-12">
                <div class="box p-a">
                    <h6>{{ __('backend.AttachFiles') }}</h6>
                    <hr>
                    <div class="row">
                        <?php
                        $img_type = array(".gif", ".jpeg", ".png", ".jpg");
                        ?>
                        @foreach(Session::get('WebmailToEdit')->files as $file)
                            <div class="col-sm-3">
                                <?php
                                $ext = strrchr($file->file, ".");
                                $ext = strtolower($ext);
                                if(!in_array($ext, $img_type)) {
                                ?>
                                <a href="{{ asset('uploads/inbox/'.$file->file) }}"
                                   style="display: block;padding: 10px;border: 1px solid #eee"
                                   target="_blank"><strong>{!! $file->file !!}</strong></a>
                                <?php
                                }else {
                                ?>
                                <a href="{{ asset('uploads/inbox/'.$file->file) }}"
                                   target="_blank"><img
                                        src="{{ asset('uploads/inbox/'.$file->file) }}"
                                        style="max-width: 100%" alt=""></a>
                                <?php
                                }
                                ?>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
