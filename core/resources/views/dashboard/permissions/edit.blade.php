@extends('dashboard.layouts.master')
@section('title', __('backend.editPermissions'))
@section('content')
    <div class="padding">
        <div class="box m-b-0">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editPermissions') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    <a href="">{{ __('backend.settings') }}</a> /
                    <a href="">{{ __('backend.usersPermissions') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("users")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <?php
        $tab_1 = "active";
        $tab_2 = "";
        $tab_3 = "";
        if (Session::has('tab')) {
            if (Session::get('tab') == "home") {
                $tab_1 = "";
                $tab_2 = "active";
                $tab_3 = "";
            }
        }
        ?>
        <div class="box nav-active-border b-info">
            <ul class="nav nav-md">
                <li class="nav-item inline">
                    <a class="nav-link {{ $tab_1 }}" href data-toggle="tab" data-target="#tab_details">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ __('backend.editPermissions') }}</span>
                    </a>
                </li>
                <li class="nav-item inline">
                    <a class="nav-link  {{ $tab_2 }}" href data-toggle="tab" data-target="#tab_custom">
                    <span class="text-md"><i class="material-icons">
                            &#xe31f;</i> {{ __('backend.customHome') }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content clear b-t">
                <div class="tab-pane  {{ $tab_1 }}" id="tab_details">
                    <div class="box-body">
                        {{Form::open(['route'=>['permissionsUpdate',$Permissions->id],'method'=>'POST'])}}
                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-2 form-control-label">{!!  __('backend.title') !!}
                            </label>
                            <div class="col-sm-10">
                                {!! Form::text('name',$Permissions->name, array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permissions1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.dataManagements') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('view_status','1',($Permissions->view_status==1) ? true : false, array('id' => 'view_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.dataManagements1') }}
                                    </label>
                                    <br>
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('view_status','0',($Permissions->view_status==0) ? true : false, array('id' => 'view_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.dataManagements2') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="analytics_status"
                                   class="col-sm-2 form-control-label">{!!  __('backend.activeApps') !!}
                            </label>
                            <div class="col-sm-10">
                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('analytics_status','1',($Permissions->analytics_status==1) ? true : false, array('id' => 'analytics_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="analytics_status">{{ __('backend.visitorsAnalytics') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('newsletter_status','1',($Permissions->newsletter_status==1) ? true : false, array('id' => 'newsletter_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="newsletter_status">{{ __('backend.newsletter') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('inbox_status','1',($Permissions->inbox_status==1) ? true : false, array('id' => 'inbox_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="inbox_status">{{ __('backend.siteInbox') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('calendar_status','1',($Permissions->calendar_status==1) ? true : false, array('id' => 'calendar_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="calendar_status">{{ __('backend.calendar') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('banners_status','1',($Permissions->banners_status==1) ? true : false, array('id' => 'banners_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="banners_status">{{ __('backend.adsBanners') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('settings_status','1',($Permissions->settings_status==1) ? true : false, array('id' => 'settings_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="settings_status">{{ __('backend.generalSettings') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="checkbox">
                                            <label class="ui-check">
                                                {!! Form::checkbox('webmaster_status','1',($Permissions->webmaster_status==1) ? true : false, array('id' => 'webmaster_status')) !!}
                                                <i class="dark-white"></i><label
                                                    for="webmaster_status">{{ __('backend.webmasterTools') }}</label>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data_sections0"
                                   class="col-sm-2 form-control-label">{!!  __('backend.activeSiteSections') !!}
                            </label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <?php
                                    $i = 0;
                                    $title_var = "title_" . @Helper::currentLanguage()->code;
                                    $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
                                    ?>
                                    @foreach($GeneralWebmasterSections as $WebSection)
                                        <?php
                                        if ($WebSection->$title_var != "") {
                                            $WSectionTitle = $WebSection->$title_var;
                                        } else {
                                            $WSectionTitle = $WebSection->$title_var2;
                                        }

                                        $data_sections_arr = explode(",", $Permissions->data_sections);
                                        ?>
                                        <div class="col-sm-4">
                                            <div class="checkbox">
                                                <label class="ui-check">
                                                    {!! Form::checkbox('data_sections[]',$WebSection->id,(in_array($WebSection->id,$data_sections_arr)) ? true : false, array('id' => 'data_sections'.$i)) !!}
                                                    <i class="dark-white"></i><label
                                                        for="data_sections{{$i}}">{!! $WSectionTitle !!}</label>
                                                </label>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="add_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.topicsStatus') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('active_status','1',($Permissions->active_status==1) ? true : false, array('id' => 'active_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('active_status','0',($Permissions->active_status==0) ? true : false, array('id' => 'active_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.notActive') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="add_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.addPermission') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('add_status','1',($Permissions->add_status==1) ? true : false, array('id' => 'add_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('add_status','0',($Permissions->add_status==0) ? true : false, array('id' => 'add_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.editPermission') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('edit_status','1',($Permissions->edit_status==1) ? true : false, array('id' => 'edit_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('edit_status','0',($Permissions->edit_status==0) ? true : false, array('id' => 'edit_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="delete_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.deletePermission') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('delete_status','1',($Permissions->delete_status==1) ? true : false, array('id' => 'delete_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                        {!! Form::radio('delete_status','0',($Permissions->delete_status==0) ? true : false, array('id' => 'delete_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="link_status"
                                   class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','1',($Permissions->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','0',($Permissions->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.notActive') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row m-t-md">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary  m-t"><i class="material-icons">
                                        &#xe31b;</i> {!! __('backend.update') !!}</button>
                                <a href="{{route("users")}}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>

                <div class="tab-pane  {{ $tab_2 }}" id="tab_custom">
                    <div class="box-body">
                        @include('dashboard.permissions.home.custom')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push("after-scripts")
    <script type="text/javascript">
        $(document).ready(function () {
            $("#home_status2").click(function () {
                $("#home_details_div").css("display", "none");
            });
            $("#home_status1").click(function () {
                $("#home_details_div").css("display", "block");
            });

            $('#btn_update_form').submit(function (evt) {
                evt.preventDefault();
                $('#link_update_submit').html("<img src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 25px\"/> {!! __('backend.add') !!}");
                $('#link_update_submit').prop('disabled', true);
                var formData = new FormData(this);
                var xhr = $.ajax({
                    type: "POST",
                    url: "<?php echo route("customLinksUpdate"); ?>",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        $('#btn_edit_errors').find("ul").html('');
                        if (result.stat == 'success') {
                            $('#btn_edit_errors').hide();
                            document.getElementById("btn_update_form").reset();
                            $('#link_edit').modal('hide');
                            list_btns();
                        } else {
                            $.each(result.error, function (key, value) {
                                $('#btn_edit_errors').find("ul").append('<li>' + value + '</li>');
                            });
                        }
                        $('#link_update_submit').html("<i class=\"material-icons\">&#xe31b;</i> {!! __('backend.save') !!}");
                        $('#link_update_submit').prop('disabled', false);
                    }
                });
                console.log(xhr);
                return false;
            });
            $('#btn_add_form').submit(function (evt) {
                evt.preventDefault();
                $('#btn_add_form_submit').html("<img src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 25px\"/> {!! __('backend.add') !!}");
                $('#btn_add_form_submit').prop('disabled', true);
                var formData = new FormData(this);
                var xhr = $.ajax({
                    type: "POST",
                    url: "<?php echo route("customLinksStore"); ?>",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        $('#btn_add_errors').find("ul").html('');
                        if (result.stat == 'success') {
                            $('#btn_add_errors').hide();
                            document.getElementById("btn_add_form").reset();
                            $('#link_add').modal('hide');
                            list_btns();
                        } else {
                            $('#btn_add_errors').css('display', 'block');
                            $.each(result.error, function (key, value) {
                                $('#btn_add_errors').find("ul").append('<li>' + value + '</li>');
                            });
                        }
                        $('#btn_add_form_submit').html("{!! __('backend.add') !!}");
                        $('#btn_add_form_submit').prop('disabled', false);
                    }
                });
                console.log(xhr);
                return false;
            });
            list_btns();

            $('#btns_delete_btn').click(function () {
                $(this).html("<img src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 25px\"/> {!! __('backend.yes') !!}");
                var row_id = $(this).attr('row-id');
                if (row_id != "") {
                    $.ajax({
                        type: "GET",
                        url: "<?php echo route("customLinksDestroy"); ?>/" + row_id + "/{{ $Permissions->id }}",
                        success: function (result) {
                            if (result.stat == 'success') {
                                $('#btns_delete_btn').html("{!! __('backend.yes') !!}");
                                $('#btns-delete').modal('hide');
                                $('.modal-backdrop').hide();
                                list_btns();
                            }
                        }
                    });
                }
            });
        });

        function list_btns() {
            $('#buttons_list').html("<div class=\"text-center\"><img class=\"m-b-1\" src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 35px;\"/></div>");
            $.get("{{ route("customLinksList") }}/{{ $Permissions->id }}", function (data) {
                $('#buttons_list').html(data);
            });
        }

        function setToDelLink(rid) {
            $("#btns_delete_btn").attr("row-id", rid);
            $('#btns-delete').modal('show');
        }

        function setToEditLink(rid) {
            $('#link_edit').modal('show');
            $('#buttons_edit_details').html("<div class=\"text-center\"><img class=\"m-b-1\" src=\"{{ asset('assets/dashboard/images/loading.gif') }}\" style=\"height: 35px;\"/></div>");
            $.get("{{ route("customLinksEdit") }}/" + rid + "/{{ $Permissions->id }}", function (data) {
                $('#buttons_edit_details').html(data);
            });
        }
    </script>
@endpush
