@extends('dashboard.layouts.master')
@section('title', __('backend.appUsers'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe241;</i> {{ __('backend.viewDetails') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appUsers') }}">{{ __('backend.appUsers') }}</a> /
                    {{ __('backend.viewDetails') }}
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("appUsers")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                <div class="form-group row">
                    <label for="username"
                           class="col-sm-2 form-control-label">{!!  __('backend.userName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('username',$UserApp->username, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'username')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="phone"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPhone') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('phone',$UserApp->phone, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'phone')) !!}
                    </div>
                </div>
                
                

                <div class="form-group row">
                    <label for="email"
                           class="col-sm-2 form-control-label">{!!  __('backend.userEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('email',$UserApp->email, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'email')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('password','', array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'password')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="rePassword"
                           class="col-sm-2 form-control-label">{!!  __('backend.userRePassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('rePassword','', array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'rePassword')) !!}
                    </div>
                </div>
                
                

                <div class="form-group row">
                    <label for="photo_file"
                           class="col-sm-2 form-control-label">{!!  __('backend.topicPhoto') !!}</label>
                    <div class="col-sm-10">
                        @if($UserApp->image!="")
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="user_photo" class="col-sm-4 box p-a-xs">
                                        <a target="_blank"
                                           href="{{ asset('API22544445213/assets/images/avatar/'.$UserApp->image) }}"><img src="{{ asset('API22544445213/assets/images/avatar/'.$UserApp->image) }}" class="img-responsive">
                                            {{ $UserApp->image }}
                                        </a>
                                        <br>

                                    </div>
                                  
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                
                
                
                
                <div class="form-group row">
                    <label for="company_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.userCompanyName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('company_name',$UserApp->company_name, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'company_name')) !!}
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="office_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.userOfficeName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_name',$UserApp->office_name, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'office_name')) !!}
                    </div>
                </div>
                
                
                
                
                
                
                <div class="form-group row">
                    <label for="about"
                           class="col-sm-2 form-control-label">{!!  __('backend.userAbout') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('about',$UserApp->about, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'about')) !!}
                    </div>
                </div>

                    <div class="form-group row">
                        <label for="verified" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            
                               <i class="fa {{ ($UserApp->verified==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                           
                        </div>
                    </div>
                    
                    
                    


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">

                        <a href="{{route("appUsers")}}"
                           class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.returnTo') !!}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
