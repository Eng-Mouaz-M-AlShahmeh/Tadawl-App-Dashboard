@extends('dashboard.layouts.master')
@section('title', __('backend.inbox'))
@section('content')
    @foreach($WebmailsGroups as $WebmailsGroup)
        <!-- .modal -->
        <div id="mg-{{ $WebmailsGroup->id }}" class="modal fade"
             data-backdrop="true">
            <div class="modal-dialog" id="animate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                    </div>
                    <div class="modal-body text-center p-lg">
                        <p>
                            {{ __('backend.confirmationDeleteMsg') }}
                            <br>
                            <strong>[ {{ $WebmailsGroup->name }}
                                ]</strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn dark-white p-x-md"
                                data-dismiss="modal">{{ __('backend.no') }}</button>
                        <a href="{{ route("webmailsDestroyGroup",["id"=>$WebmailsGroup->id]) }}"
                           class="btn danger p-x-md">{{ __('backend.yes') }}</a>
                    </div>
                </div><!-- /.modal-content -->
            </div>
        </div>
        <!-- / .modal -->
    @endforeach
    <!-- .modal -->
    <div id="m-all" class="modal fade" data-backdrop="true">
        <div class="modal-dialog" id="animate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('backend.confirmation') }}</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <p>
                        {{ __('backend.confirmationDeleteMsg') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark-white p-x-md"
                            data-dismiss="modal">{{ __('backend.no') }}</button>
                    <button type="button"
                            onclick="document.getElementById('action').value='delete';document.getElementById('UpdateAll').submit()"
                            class="btn danger p-x-md">{{ __('backend.yes') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!-- / .modal -->

    <?php
    $connectEmailAddress = "";
    $connectEmailPassword = "";
    $connectDomainURL = "";
    $nMsgCount = "";
    if (Auth::user()->connect_email != "" && Auth::user()->connect_password) {
        try {
            $connectEmailAddress = Auth::user()->connect_email; // Full email address
            $connectEmailPassword = Auth::user()->connect_password;        // Email password
            $connectDomainURL = substr($connectEmailAddress, strpos($connectEmailAddress, "@") + 1);              // Your websites domain
            $useHTTPS = true;                       // Depending on how your cpanel is set up, you may be using a secure connection and you may not be. Change this from true to false as needed for your situation

            /* BEGIN MESSAGE COUNT CODE */

            $inbox = imap_open('{' . $connectDomainURL . ':143/notls}INBOX', $connectEmailAddress, $connectEmailPassword) or die('');
            $oResult = imap_search($inbox, 'UNSEEN');

            if (empty($oResult))
                $nMsgCount = 0;
            else
                $nMsgCount = count($oResult);

            imap_close($inbox);
        } catch (Exception $e) {

        }
    }
    ?>

    <div class="row-col">
        <div class="col-sm ww-md w-auto-xs light lt bg-auto  hidden-print">
            <div class="padding pos-rlt">
                <div>
                    <button class="btn btn-sm white pull-right hidden-sm-up p-r-3" ui-toggle-class="show"
                            target="#inbox-menu"><i class="fa fa-bars"></i></button>
                    <a href="{{ route("webmails",["group_id"=>"create"]) }}"
                       class="btn white w-full"> <i class="material-icons">
                            &#xe145;</i>&nbsp; {!! __('backend.compose') !!}</a>
                </div>
                <div class="hidden-xs-down m-t" id="inbox-menu">
                    <?php
                    $cat_id = "3";
                    if (Session::has('WebmailToEdit')) {
                        $group_id = Session::get('WebmailToEdit')->group_id;
                        $cat_id = Session::get('WebmailToEdit')->cat_id;
                    }
                    ?>
                    <div class="nav-active-primary">
                        <div class="nav nav-pills nav-sm">
                            <a class="nav-link {{ (($group_id=="" || $cat_id ==0) && ( ($cat_id !=1  && $cat_id !=2) || (!Session::has('WebmailToEdit'))))? "active":"" }}"
                               href="{{ route("webmails") }}">
                                {!! __('backend.inbox') !!} {{ ($WaitWebmailsCount >0)? "($WaitWebmailsCount)":"" }}
                            </a>
                            <a class="nav-link {{ ($group_id=="sent" || $cat_id ==1)? "active":"" }}"
                               href="{{ route("webmails",["group_id"=>"sent"]) }}">
                                {!! __('backend.sent') !!}
                            </a>
                            <a class="nav-link {{ ($group_id=="draft" || $cat_id ==2)? "active":"" }}"
                               href="{{ route("webmails",["group_id"=>"draft"]) }}">
                                {!! __('backend.draft') !!} {{ ($DraftWebmailsCount >0)? "($DraftWebmailsCount)":"" }}
                            </a>

                        </div>
                    </div>
                    @if(count($WebmailsGroups)>0)
                        <br>
                        <div class="m-y text-muted">{!! __('backend.labels') !!}</div>
                        <div class="nav-active-white">
                            <ul class="nav nav-pills nav-stacked nav-sm">
                                <li class="nav-item">
                                    <ul class="list" style="list-style: none;">
                                        @foreach($WebmailsGroups as $WebmailsGroup)
                                            <li style="margin-bottom: 5px"
                                                onmouseover="document.getElementById('grpRow{{ $WebmailsGroup->id }}').style.display='block'"
                                                onmouseout="document.getElementById('grpRow{{ $WebmailsGroup->id }}').style.display='none'">
                                                <a href="{{ route("webmails",["group_id"=>$WebmailsGroup->id]) }}"
                                                    {!!   ($WebmailsGroup->id == $group_id) ? " style='font-weight: bold;color:#0cc2aa'":""  !!} >
                                                    <i class="fa m-r-sm fa-circle"
                                                       style="color: {{$WebmailsGroup->color}}"></i>
                                                    {!! $WebmailsGroup->name !!}
                                                    <small>({{ count($WebmailsGroup->webmails) }})</small>
                                                </a>

                                                <div id="grpRow{{ $WebmailsGroup->id }}"
                                                     style="display: none"
                                                     class="pull-right">
                                                    <a class="btn btn-sm success p-a-0 m-a-0"
                                                       title="{{ __('backend.edit') }}"
                                                       href="{{ route("webmailsEditGroup",["id"=>$WebmailsGroup->id]) }}">
                                                        <small>&nbsp;<i class="material-icons">&#xe3c9;</i>&nbsp;
                                                        </small>
                                                    </a>
                                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                                        <button class="btn btn-sm warning p-a-0 m-a-0"
                                                                data-toggle="modal"
                                                                data-target="#mg-{{ $WebmailsGroup->id }}"
                                                                ui-toggle-class="bounce"
                                                                title="{{ __('backend.delete') }}"
                                                                ui-target="#animate">
                                                            <small>&nbsp;<i class="material-icons">&#xe872;</i>&nbsp;
                                                            </small>
                                                        </button>
                                                    @endif

                                                </div>

                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="p-y">
                        @if(Session::has('EditWebmailsGroup'))
                            {{Form::open(['route'=>['webmailsUpdateGroup',Session::get('EditWebmailsGroup')->id],'method'=>'POST'])}}
                            <div class="input-group input-group-sm">
                                {!! Form::text('name',Session::get('EditWebmailsGroup')->name, array('placeholder' => __('backend.newGroup'),'class' => 'form-control','required'=>'')) !!}
                                <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! __('backend.save') !!}</button>
              </span>
                            </div>
                            {{Form::close()}}
                        @else
                            {{Form::open(['route'=>['webmailsStoreGroup'],'method'=>'POST'])}}
                            <div class="input-group input-group-sm">
                                {!! Form::text('name','', array('placeholder' => __('backend.newGroup'),'class' => 'form-control','required'=>'')) !!}
                                <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit">{!! __('backend.add') !!}</button>
              </span>
                            </div>
                            {{Form::close()}}
                        @endif
                    </div>
                    <hr>
                    @if( $connectEmailAddress !="" )
                        <a class="nav-link" target="_blank"
                           href="<?php echo 'http' . ($useHTTPS ? 's' : '') . '://' . $connectDomainURL . ':' . ($useHTTPS ? '2096' : '2095') . '/login/?user=' . $connectEmailAddress . '&pass=' . $connectEmailPassword . '&failurl=http://' . $connectDomainURL; ?>">
                            {!! __('backend.openWebmail') !!}
                            @if($nMsgCount >0 )
                                <span class="label warn m-l-xs">{{ $nMsgCount }}</span>
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div ui-view class="padding">
                @if($group_id!="create" && !Session::has('WebmailToEdit'))
                    <a href="{{ route("webmails",["group_id"=>"create"]) }}"
                       class="md-btn md-fab md-fab-bottom-right pos-fix red">
                        <i class="material-icons i-24 text-white">&#xe150;</i>
                    </a>
                @endif
                <div>
                    @if(Session::has('doneMessage2'))
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    {{ Session::get('doneMessage2') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('WebmailToEdit'))
                        @include('dashboard.inbox.edit')
                    @elseif($group_id=="create")
                        @include('dashboard.inbox.create')
                    @else


                        @if($Webmails->total() == 0)
                            <div class="row p-a">
                                <div class="col-sm-12">
                                    <div class=" p-a text-center ">
                                        {{ __('backend.noData') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($Webmails->total() > 0)

                        <!-- header -->
                            <div class="p-a light dk">
                                <div class="btn-group pull-right">
                                    {{Form::open(['route'=>['webmailsSearch'],'method'=>'POST'])}}
                                    <div class="input-group input-group-sm">
                                        {!! Form::text('q',$search_word, array('placeholder' => __('backend.search')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                        <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                    </div>
                                    {{Form::close()}}
                                </div>
                                <div class="btn-toolbar">
                                    <div class="btn-group">
                                        <label class="ui-check" style="margin-top: 5px;">
                                            <input id="checkAll" type="checkbox"><i style="background: #fff"></i>
                                        </label>
                                    </div>
                                    <div class="btn-group dropdown">
                                        <button class="btn white btn-sm dropdown-toggle" data-toggle="dropdown">
                                            <span class="dropdown-label">{{ __('backend.options') }}</span>
                                            <span class="caret"></span>
                                        </button>

                                        <div class="dropdown-menu text-left text-sm">
                                            <a class="dropdown-item"
                                               onclick="document.getElementById('action').value='read';document.getElementById('UpdateAll').submit()"><i
                                                    class="material-icons">
                                                    &#xe151;</i> {{ __('backend.makeAsRead') }}</a>
                                            <a class="dropdown-item"
                                               onclick="document.getElementById('action').value='unread';document.getElementById('UpdateAll').submit()"><i
                                                    class="material-icons">
                                                    &#xe159;</i> {{ __('backend.makeAsUnread') }}</a>
                                            @if(@Auth::user()->permissionsGroup->delete_status)
                                                <a class="dropdown-item" data-toggle="modal" data-target="#m-all"
                                                   ui-toggle-class="bounce" ui-target="#animate"><i
                                                        class="material-icons">
                                                        &#xe872;</i> {{ __('backend.delete') }}</a>
                                            @endif
                                            @if(count($WebmailsGroups) >0)
                                                <div class="dropdown-divider"></div>
                                                @foreach($WebmailsGroups as $WebmailsGroup)
                                                    <a class="dropdown-item"
                                                       onclick="document.getElementById('group').value='{{$WebmailsGroup->id}}';document.getElementById('action').value='move';document.getElementById('UpdateAll').submit()">{{ __('backend.moveTo') }}
                                                        <strong
                                                            style="color:{!! $WebmailsGroup->color !!} ">{!! $WebmailsGroup->name !!}</strong>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- / header -->


                            {{Form::open(['route'=>'webmailsUpdateAll','method'=>'post','id'=>'UpdateAll'])}}
                        <!-- list -->
                            <input type="hidden" id="action" name="action" value="">
                            <input type="hidden" id="group" name="group" value="">
                            <div class="list white">
                                @foreach($Webmails as $Webmail)
                                    <?php
                                    $s4ds_current_date = date('Y-m-d', $_SERVER['REQUEST_TIME']);
                                    $day_mm = date('Y-m-d', strtotime($Webmail->date));
                                    if ($day_mm == $s4ds_current_date) {
                                        $dtformated = date('h:i A', strtotime($Webmail->date));
                                    } else {
                                        $dtformated = date('d M Y', strtotime($Webmail->date));
                                    }

                                    try {
                                        $groupColor = $Webmail->webmailsGroup->color;
                                        $groupName = $Webmail->webmailsGroup->name;
                                    } catch (Exception $e) {
                                        $groupColor = "";
                                        $groupName = "";
                                    }

                                    $fontStyle = "";
                                    $unreadIcon = "";
                                    $unreadbg = "";
                                    $unreadText = "";
                                    if ($Webmail->status == 0) {
                                        $fontStyle = "_700";
                                        $unreadIcon = "<i class=\"fa fa-envelope\"></i>";
                                        $unreadbg = "style=\"background: $groupColor \"";
                                        $unreadText = "style=\"color: $groupColor \"";
                                    }
                                    ?>
                                    <div class="list-item b-l b-l-2x" style="border-color: {{$groupColor}}">
                                        <div class="list-left">
                                            <label class="ui-check m-a-0">
                                                <input type="checkbox" name="ids[]" value="{{ $Webmail->id }}"><i
                                                    class="dark-white"></i>
                                            </label>
                                            @if(count($Webmail->files))
                                                <i class="fa fa-paperclip m-l-sm text-muted text-xs" {!! $unreadText !!}></i>
                                            @endif
                                        </div>
                                        <div class="list-body" style="cursor: pointer;"
                                             onclick="location.href='{{ route("webmailsEdit",["id"=>$Webmail->id]) }}'">
                                            <div class="pull-right text-muted text-xs">
                                                <span
                                                    class="hidden-xs  {{$fontStyle}}" {!! $unreadText !!}>{{ $dtformated }}</span>

                                            </div>
                                            <div>
                                                <a href="{{ route("webmailsEdit",["id"=>$Webmail->id]) }}"
                                                   class="_500 {{$fontStyle}}" {!! $unreadText !!}>
                                                    @if($group_id=="sent" || $group_id=="draft")
                                                        {{ $Webmail->title }}
                                                    @else
                                                        {{ $Webmail->from_name }}
                                                    @endif
                                                </a>
                                                @if($groupName !="")
                                                    <span class="label m-l-sm text-u-c" {!! $unreadbg !!}>
                                      {{ $groupName }}
                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-ellipsis text-muted text-sm ">
                                                <a href="{{ route("webmailsEdit",["id"=>$Webmail->id]) }}"
                                                   class=" {{$fontStyle}}" {!! $unreadText !!}>
                                                    {!! $unreadIcon !!}
                                                    @if($group_id=="sent" || $group_id=="draft")
                                                        {{ $Webmail->to_email }}
                                                    @else
                                                        {{ $Webmail->title }}
                                                    @endif

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {!! $Webmails->links() !!}
                            </div>
                            {{Form::close()}}
                        @endif
                    <!-- / list -->
                    @endif
                </div>

            </div>
        </div>
    </div>
    <style>
        .modal-backdrop {
            z-index: 1;
        }
    </style>
@endsection
@push("after-scripts")
    <script type="text/javascript">
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#action").change(function () {
            if (this.value == "delete") {
                $("#submit_all").css("display", "none");
                $("#submit_show_msg").css("display", "inline-block");
            } else {
                $("#submit_all").css("display", "inline-block");
                $("#submit_show_msg").css("display", "none");
            }
        });
    </script>
@endpush
