@extends('dashboard.layouts.master')
@section('title', __('backend.adsBannersSettings'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ __('backend.addNewBannerType') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.webmasterTools') }} /
                    <a href="">{{ __('backend.adsBannersSettings') }}</a>
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("WebmasterBanners")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                {{Form::open(['route'=>['WebmasterBannersStore'],'method'=>'POST'])}}
                @foreach(Helper::languagesList() as $ActiveLanguage)
                    <div class="form-group row">
                        <label
                            class="col-sm-2 form-control-label">{!!  __('backend.sectionName') !!} {!! @Helper::languageName($ActiveLanguage) !!}
                        </label>
                        <div class="col-sm-10">
                            {!! Form::text('title_'.@$ActiveLanguage->code,'', array('placeholder' => '','class' => 'form-control','required'=>'', 'dir'=>@$ActiveLanguage->direction)) !!}
                        </div>
                    </div>
                @endforeach
                <div class="form-group row">
                    <label for="type"
                           class="col-sm-2 form-control-label">{!!  __('backend.sectionType') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','0',true, array('id' => 'site_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.sectionTypeCode') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','1',false, array('id' => 'site_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.sectionTypePhoto') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('type','2',false, array('id' => 'site_status3','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.sectionTypeVideo') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="width"
                           class="col-sm-2 form-control-label">{!!  __('backend.size') !!}</label>
                    <div class="col-sm-2">
                        {!! Form::number('width','', array('placeholder' => __('backend.width'),'class' => 'form-control','id'=>'width','required'=>'','min'=>'0')) !!}
                    </div>
                    <div class="col-sm-1 text-center" style="width: 30px !important;padding-top: 10px;">
                        X
                    </div>
                    <div class="col-sm-2">
                        {!! Form::number('height','', array('placeholder' => __('backend.height'),'class' => 'form-control','id'=>'height','required'=>'','min'=>'0')) !!}
                    </div>
                    <div class="col-sm-1 text-center" style="width: 30px !important;padding-top: 10px;">
                        PX
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc_status"
                           class="col-sm-2 form-control-label">{!!  __('backend.descriptionBox') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('desc_status','1',true, array('id' => 'desc_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('desc_status','0',false, array('id' => 'desc_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="link_status"
                           class="col-sm-2 form-control-label">{!!  __('backend.linkBox') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('link_status','1',true, array('id' => 'link_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('link_status','0',false, array('id' => 'link_status2','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.no') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon_status1"
                           class="col-sm-2 form-control-label">{!!  __('backend.iconPicker') !!}</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('icon_status','1',false, array('id' => 'icon_status1','class'=>'has-value')) !!}
                                <i class="dark-white"></i>
                                {{ __('backend.yes') }}
                            </label>
                            &nbsp; &nbsp;
                            <label class="ui-check ui-check-md">
                                {!! Form::radio('icon_status','0',true, array('id' => 'icon_status2','class'=>'has-value')) !!}
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
                        <a href="{{route("WebmasterBanners")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
