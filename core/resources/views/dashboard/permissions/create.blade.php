@extends('dashboard.layouts.master')
@section('title', __('backend.newPermissions'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe03b;</i> {{ __('backend.newPermissions') }}</h3>
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
            <div class="box-body">
                {{Form::open(['route'=>['permissionsStore'],'method'=>'POST'])}}

                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  __('backend.title') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name','', array('placeholder' => '','class' => 'form-control','id'=>'name','required'=>'')) !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label for="permissions1"
                           class="col-sm-2 form-control-label">{!!  __('backend.dataManagements') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','1',true, array('id' => 'view_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.dataManagements1') }}
                            </label>
                            <br>
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('view_status','0',false, array('id' => 'view_status2','class'=>'has-value')) !!}
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
                                        {!! Form::checkbox('analytics_status','1',false, array('id' => 'analytics_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="analytics_status">{{ __('backend.visitorsAnalytics') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('newsletter_status','1',false, array('id' => 'newsletter_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="newsletter_status">{{ __('backend.newsletter') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('inbox_status','1',false, array('id' => 'inbox_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="inbox_status">{{ __('backend.siteInbox') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('calendar_status','1',false, array('id' => 'calendar_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="calendar_status">{{ __('backend.calendar') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('banners_status','1',false, array('id' => 'banners_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="banners_status">{{ __('backend.adsBanners') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('settings_status','1',false, array('id' => 'settings_status')) !!}
                                        <i class="dark-white"></i><label
                                            for="settings_status">{{ __('backend.generalSettings') }}</label>
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label class="ui-check">
                                        {!! Form::checkbox('webmaster_status','1',false, array('id' => 'webmaster_status')) !!}
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
                            @foreach($GeneralWebmasterSections as $WebmasterSection)
                                <?php
                                if ($WebmasterSection->$title_var != "") {
                                    $WSectionTitle = $WebmasterSection->$title_var;
                                } else {
                                    $WSectionTitle = $WebmasterSection->$title_var2;
                                }
                                ?>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label class="ui-check">
                                            {!! Form::checkbox('data_sections[]',$WebmasterSection->id,false, array('id' => 'data_sections'.$i)) !!}
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
                                {!! Form::radio('active_status','1',true, array('id' => 'active_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.active') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('active_status','0',false, array('id' => 'active_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('add_status','1',true, array('id' => 'add_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('add_status','0',false, array('id' => 'add_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('edit_status','1',true, array('id' => 'edit_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('edit_status','0',false, array('id' => 'edit_status2','class'=>'has-value')) !!}
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
                                {!! Form::radio('delete_status','1',true, array('id' => 'delete_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md" style="margin-bottom: 5px;">
                                {!! Form::radio('delete_status','0',false, array('id' => 'delete_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.no') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.add') !!}</button>
                        <a href="{{route("users")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
