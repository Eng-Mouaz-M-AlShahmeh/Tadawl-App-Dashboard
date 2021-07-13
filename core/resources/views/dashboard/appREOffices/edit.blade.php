@extends('dashboard.layouts.master')
@section('title', __('backend.appREOffices'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editREOffice') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appREOffices') }}">{{ __('backend.appREOffices') }}</a>
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
                {{Form::open(['route'=>['appREOfficesUpdate',$REOffice->id],'method'=>'POST', 'files' => true])}}

                <div class="form-group row">
                    <label for="office_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_name') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_name',$REOffice->office_name, array('placeholder' => '','class' => 'form-control','id'=>'office_name','required'=>'')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="office_lat"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_lat') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('office_lat',$REOffice->office_lat, array('placeholder' => '','class' => 'form-control','id'=>'office_lat','required'=>'')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="office_lng"
                           class="col-sm-2 form-control-label">{!!  __('backend.office_lng') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('office_lng',$REOffice->office_lng, array('placeholder' => '','class' => 'form-control','id'=>'office_lng','required'=>'')) !!}
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="sejel"
                           class="col-sm-2 form-control-label">{!!  __('backend.sejel') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('sejel',$REOffice->sejel, array('placeholder' => '','class' => 'form-control','id'=>'sejel','required'=>'')) !!}
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="phone_user"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPhone') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::number('phone_user',$REOffice->phone_user, array('placeholder' => '','class' => 'form-control','id'=>'phone_user','required'=>'')) !!}
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
                                        <a onclick="document.getElementById('sejel_image').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                           class="btn btn-sm btn-default">{!!  __('backend.delete') !!}</a>
                                    </div>
                                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                        <a onclick="document.getElementById('sejel_image').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                            <i class="material-icons">&#xe166;</i> {!!  __('backend.undoDelete') !!}
                                        </a>
                                    </div>

                                    {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                                </div>
                            </div>
                        @endif

                        {!! Form::file('sejel_image', array('class' => 'form-control','id'=>'sejel_image','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  __('backend.imagesTypes') !!}
                        </small>
                    </div>
                </div>
                
                
                
                
           

                    <div class="form-group row">
                        <label for="state" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('state','1',($REOffice->state==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('state','0',($REOffice->state==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    

                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{route("appREOffices")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
