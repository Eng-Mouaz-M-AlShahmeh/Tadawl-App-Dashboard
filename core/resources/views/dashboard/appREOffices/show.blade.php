@extends('dashboard.layouts.master')
@section('title', __('backend.appREOffices'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe241;</i> {{ __('backend.viewDetails') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appREOffices') }}">{{ __('backend.appREOffices') }}</a> /
                    {{ __('backend.viewDetails') }}
                </small>
            </div>
            <div class="box-tool">
                <ul class="nav">
                    <li class="nav-item inline">
                        <a class="nav-link" href="{{route("appREOffices")}}">
                            <i class="material-icons md-18">×</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="box-body">
                
                <div class="form-group row">
                    <label for="office_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_name') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_name',$REOffice->office_name, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'office_name')) !!}
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="office_lat"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_lat') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_lat',$REOffice->office_lat, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'office_lat')) !!}
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="office_lng"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_lng') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_lng',$REOffice->office_lng, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'office_lng')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="sejel"
                           class="col-sm-2 form-control-label">{!!  __('backend.sejel') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('sejel',$REOffice->sejel, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'sejel')) !!}
                    </div>
                </div>
                
                
                
                
                
                <div class="form-group row">
                    <label for="phone"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPhone') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('phone_user',$REOffice->phone_user, array('placeholder' => '','class' => 'form-control', 'readonly' => 'true', 'id'=>'phone_user')) !!}
                    </div>
                </div>
                
                


                <div class="form-group row">
                    <label for="sejel_image"
                           class="col-sm-2 form-control-label">{!!  __('backend.sejel_image') !!}</label>
                    <div class="col-sm-10">
                        @if($REOffice->sejel_image!="")
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="sejel_image" class="col-sm-4 box p-a-xs">
                                        <a target="_blank"
                                           href="{{ asset('API22544445213/assets/images/offices/'.$REOffice->sejel_image) }}"><img src="{{ asset('API22544445213/assets/images/offices/'.$REOffice->sejel_image) }}" class="img-responsive">
                                            {{ $REOffice->sejel_image }}
                                        </a>
                                        <br>

                                    </div>
                                  
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                
          
        

                    <div class="form-group row">
                        <label for="state" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            
                               <i class="fa {{ ($REOffice->state==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                           
                        </div>
                    </div>
                    
                    
                    


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">

                        <a href="{{route("appREOffices")}}"
                           class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.returnTo') !!}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
