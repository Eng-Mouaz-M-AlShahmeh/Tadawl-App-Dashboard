@extends('dashboard.layouts.master')
@section('title', __('backend.siteSectionsSettings'))
@section('content')
    <div class="padding">
        <div class="box m-b-0">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.sectionEdit') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.webmasterTools') }} /
                    <a href="">{{ __('backend.siteSectionsSettings') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("WebmasterSections")}}">
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
        if (Session::has('activeTab')) {
            if (Session::get('activeTab') == "fields") {
                $tab_1 = "";
                $tab_2 = "active";
                $tab_3 = "";
            }
            if (Session::get('activeTab') == "seo") {
                $tab_1 = "";
                $tab_2 = "";
                $tab_3 = "active";
            }
        }
        ?>
        <div class="box nav-active-border b-info">
            <ul class="nav nav-md">
                <li class="nav-item inline">
                    <a class="nav-link {{ $tab_1 }}" href data-toggle="tab" data-target="#tab_details">
                        <span class="text-md"><i class="material-icons">
                                &#xe31e;</i> {{ __('backend.topicTabSection') }}</span>
                    </a>
                </li>
                <li class="nav-item inline">
                    <a class="nav-link  {{ $tab_2 }}" href data-toggle="tab" data-target="#tab_custom">
                    <span class="text-md"><i class="material-icons">
                            &#xe30d;</i> {{ __('backend.customFields') }}</span>
                    </a>
                </li>
                @if(Helper::GeneralWebmasterSettings("seo_status"))
                    <li class="nav-item inline">
                        <a class="nav-link  {{ $tab_3 }}" href data-toggle="tab" data-target="#tab_seo">
                    <span class="text-md"><i class="material-icons">
                            &#xe8e5;</i> {{ __('backend.seoTabTitle') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
            <div class="tab-content clear b-t">
                <div class="tab-pane  {{ $tab_1 }}" id="tab_details">
                    <div class="box-body">
                        {{Form::open(['route'=>['WebmasterSectionsUpdate',$WebmasterSections->id],'method'=>'POST'])}}

                        @foreach(Helper::languagesList() as $ActiveLanguage)
                            <div class="form-group row">
                                <label
                                    class="col-sm-2 form-control-label">{!!  __('backend.sectionName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                                </label>
                                <div class="col-sm-10">
                                    {!! Form::text('title_'.@$ActiveLanguage->code,$WebmasterSections->{'title_'.@$ActiveLanguage->code}, array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row">
                            <label for="type"
                                   class="col-sm-2 form-control-label">{!!  __('backend.sectionType') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio secs">
                                    <div>
                                        <label
                                            class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a {{ ($WebmasterSections->type==0)?"sec-active":"" }}">
                                            {!! Form::radio('type','0',($WebmasterSections->type==0) ? true : false, array('id' => 'site_status1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="fa fa-file-text-o sec-icon pull-right"></div>
                                            <strong>{{ __('backend.typeTextPages') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.generalDesc') }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a  {{ ($WebmasterSections->type==1)?"sec-active":"" }}">
                                            {!! Form::radio('type','1',($WebmasterSections->type==1) ? true : false, array('id' => 'site_status2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="material-icons sec-icon pull-right">&#xe41d;</div>
                                            <strong>{{ __('backend.typePhotos') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.photoDesc') }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a  {{ ($WebmasterSections->type==2)?"sec-active":"" }}">
                                            {!! Form::radio('type','2',($WebmasterSections->type==2) ? true : false, array('id' => 'site_status3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="material-icons sec-icon pull-right">&#xe04b;</div>
                                            <strong>{{ __('backend.typeVideos') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.videoDesc') }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a  {{ ($WebmasterSections->type==3)?"sec-active":"" }}">
                                            {!! Form::radio('type','3',($WebmasterSections->type==3) ? true : false, array('id' => 'site_status4','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="material-icons sec-icon pull-right">&#xe3a1;</div>
                                            <strong>{{ __('backend.typeSounds') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.audioDesc') }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a  {{ ($WebmasterSections->type==5)?"sec-active":"" }}">
                                            {!! Form::radio('type','5',($WebmasterSections->type==5) ? true : false, array('id' => 'site_status6','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="fa fa-table sec-icon pull-right"></div>
                                            <strong>{{ __('backend.tableView') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.tableDesc') }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md p-y-sm w-100 p-x-2 b-a  {{ ($WebmasterSections->type==4)?"sec-active":"" }}">
                                            {!! Form::radio('type','4',($WebmasterSections->type==4) ? true : false, array('id' => 'site_status5','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            <div class="material-icons sec-icon pull-right">&#xe327;</div>
                                            <strong>{{ __('backend.private') }}</strong>
                                            <div class="m-x-sm text-muted">{{ __('backend.privateDesc') }}</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sections_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.hasCategories') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <div>
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','0',($WebmasterSections->sections_status==0) ? true : false, array('id' => 'sections_status1','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ __('backend.withoutCategories') }}
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','1',($WebmasterSections->sections_status==1) ? true : false, array('id' => 'sections_status2','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ __('backend.mainCategoriesOnly') }}
                                        </label>
                                    </div>
                                    <div>
                                        <label class="ui-check ui-check-md">
                                            {!! Form::radio('sections_status','2',($WebmasterSections->sections_status==2) ? true : false, array('id' => 'sections_status3','class'=>'has-value')) !!}
                                            <i class="dark-white"></i>
                                            {{ __('backend.mainAndSubCategories') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe1db;</i> {{ __('backend.optionalFields') }}
                                </h5></label>
                            <hr class="m-a-0">
                        </div>

                        <div class="form-group row">
                            <label for="title_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.titleField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('title_status','1',($WebmasterSections->title_status==1) ? true : false, array('id' => 'title_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('title_status','0',($WebmasterSections->title_status==0) ? true : false, array('id' => 'title_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.dateField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('date_status','1',($WebmasterSections->date_status==1) ? true : false, array('id' => 'date_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('date_status','0',($WebmasterSections->date_status==0) ? true : false, array('id' => 'date_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="expire_date_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.expireDateField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('expire_date_status','1',($WebmasterSections->expire_date_status==1) ? true : false, array('id' => 'expire_date_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('expire_date_status','0',($WebmasterSections->expire_date_status==0) ? true : false, array('id' => 'expire_date_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="longtext_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.longTextField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('longtext_status','1',($WebmasterSections->longtext_status==1) ? true : false, array('id' => 'longtext_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('longtext_status','0',($WebmasterSections->longtext_status==0) ? true : false, array('id' => 'longtext_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="editor_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.allowEditor') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('editor_status','1',($WebmasterSections->editor_status==1) ? true : false, array('id' => 'editor_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('editor_status','0',($WebmasterSections->editor_status==0) ? true : false, array('id' => 'editor_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="case_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.caseField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('case_status','1',($WebmasterSections->case_status==1) ? true : false, array('id' => 'case_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('case_status','0',($WebmasterSections->case_status==0) ? true : false, array('id' => 'case_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visits_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.visitsField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('visits_status','1',($WebmasterSections->visits_status==1) ? true : false, array('id' => 'visits_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('visits_status','0',($WebmasterSections->visits_status==0) ? true : false, array('id' => 'visits_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.photoField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('photo_status','1',($WebmasterSections->photo_status==1) ? true : false, array('id' => 'photo_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('photo_status','0',($WebmasterSections->photo_status==0) ? true : false, array('id' => 'photo_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="attach_file_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.attachFileField') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('attach_file_status','1',($WebmasterSections->attach_file_status==1) ? true : false, array('id' => 'attach_file_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('attach_file_status','0',($WebmasterSections->attach_file_status==0) ? true : false, array('id' => 'attach_file_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="section_icon_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.sectionIconPicker') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('section_icon_status','1',($WebmasterSections->section_icon_status==1) ? true : false, array('id' => 'section_icon_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('section_icon_status','0',($WebmasterSections->section_icon_status==0) ? true : false, array('id' => 'section_icon_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="icon_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.topicsIconPicker') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('icon_status','1',($WebmasterSections->icon_status==1) ? true : false, array('id' => 'icon_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('icon_status','0',($WebmasterSections->icon_status==0) ? true : false, array('id' => 'icon_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe8d8;</i> {{ __('backend.additionalTabs') }}
                                </h5></label>
                            <hr class="m-a-0">
                        </div>
                        <div class="form-group row">
                            <label for="multi_images_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.additionalImages') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('multi_images_status','1',($WebmasterSections->multi_images_status==1) ? true : false, array('id' => 'multi_images_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('multi_images_status','0',($WebmasterSections->multi_images_status==0) ? true : false, array('id' => 'multi_images_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="extra_attach_file_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.additionalFiles') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('extra_attach_file_status','1',($WebmasterSections->extra_attach_file_status==1) ? true : false, array('id' => 'extra_attach_file_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('extra_attach_file_status','0',($WebmasterSections->extra_attach_file_status==0) ? true : false, array('id' => 'extra_attach_file_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="maps_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.attachGoogleMaps') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('maps_status','1',($WebmasterSections->maps_status==1) ? true : false, array('id' => 'maps_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('maps_status','0',($WebmasterSections->maps_status==0) ? true : false, array('id' => 'maps_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="order_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.attachOrderForm') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('order_status','1',($WebmasterSections->order_status==1) ? true : false, array('id' => 'order_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('order_status','0',($WebmasterSections->order_status==0) ? true : false, array('id' => 'order_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comments_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.reviewsAvailable') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('comments_status','1',($WebmasterSections->comments_status==1) ? true : false, array('id' => 'comments_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('comments_status','0',($WebmasterSections->comments_status==0) ? true : false, array('id' => 'comments_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="related_status1"
                                   class="col-sm-2 form-control-label">{!!  __('backend.relatedTopics') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('related_status','1',($WebmasterSections->related_status==1) ? true : false, array('id' => 'related_status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.yes') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('related_status','0',($WebmasterSections->related_status==0) ? true : false, array('id' => 'related_status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.no') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br/>
                            <label><h5><i class="material-icons">&#xe8ac;</i> {{ __('backend.active_disable') }}
                                </h5></label>
                            <hr class="m-a-0">
                        </div>
                        <div class="form-group row">
                            <label for="link_status"
                                   class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','1',($WebmasterSections->status==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.active') }}
                                    </label>
                                    &nbsp; &nbsp;
                                    <label class="ui-check ui-check-md">
                                        {!! Form::radio('status','0',($WebmasterSections->status==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                        <i class="dark-white"></i>
                                        {{ __('backend.notActive') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-t-md">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                        &#xe31b;</i> {!! __('backend.update') !!}</button>
                                <a href="{{route("WebmasterSections")}}"
                                   class="btn btn-default m-t"><i class="material-icons">
                                        &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>

                {{-- Custom Fields--}}
                <div class="tab-pane  {{ $tab_2 }}" id="tab_custom">
                    <div class="box-body">
                        @if (Session::has('fieldST'))
                            @include('dashboard.webmaster.sections.fields.create')
                            @include('dashboard.webmaster.sections.fields.edit')
                        @else
                            @include('dashboard.webmaster.sections.fields.list')
                        @endif
                    </div>
                </div>
                {{-- End of Custom Fields --}}

                @include('dashboard.webmaster.sections.seo')

            </div>
        </div>
    </div>
@endsection
@push("after-scripts")
    <script type="text/javascript">

        $(".secs input[type='radio']").click(function () {
            $("label").removeClass("sec-active");
            if ($(this).is(":checked")) {
                $(this).parent().addClass("sec-active");
            }
        });
        $("#checkAll4").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $("#action4").change(function () {
            if (this.value == "delete") {
                $("#submit_all4").css("display", "none");
                $("#submit_show_msg4").css("display", "inline-block");
            } else {
                $("#submit_all4").css("display", "inline-block");
                $("#submit_show_msg4").css("display", "none");
            }
        });
        $("input:radio[name=type]").click(function () {
            if ($(this).val() == 6 || $(this).val() == 7) {
                $("#options").css("display", "inline");
                $(".in_statics_div").show();
            } else {
                $("#options").css("display", "none");
                $(".in_statics_div").hide();
            }
            $("#in_statics2").checked = true;
            if ($(this).val() == 8 || $(this).val() == 9 || $(this).val() == 10) {
                $("#default_val").css("display", "none");
            } else {
                $("#default_val").css("display", "block");
            }
        });
    </script>
@endpush
