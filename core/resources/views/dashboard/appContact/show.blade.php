@extends('dashboard.layouts.master')
@section('title', __('backend.appContactUss'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe241;</i> {{ __('backend.viewDetails') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appContactUss') }}">{{ __('backend.appContactUss') }}</a> /
                    {{ __('backend.viewDetails') }}
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("appContactUss")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="form-group row">
                    <label for="name"
                           class="col-sm-2 form-control-label">{!!  __('backend.name') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('name',$ContactUs->name, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'name')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="mobile"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPhone') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('mobile',$ContactUs->mobile, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'mobile')) !!}
                    </div>
                </div>
                
                 
                
                <div class="form-group row">
                    <label for="title"
                           class="col-sm-2 form-control-label">{!!  __('backend.title') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('title',$ContactUs->title, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'title')) !!}
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="description"
                           class="col-sm-2 form-control-label">{!!  __('backend.description') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('description',$ContactUs->description, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'description')) !!}
                    </div>
                </div>
                
           


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">

                        <a href="{{route("appContactUss")}}"
                           class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.returnTo') !!}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
