@extends('dashboard.layouts.master')
@section('title', __('backend.appUsers'))
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe3c9;</i> {{ __('backend.editUser') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appUsers') }}">{{ __('backend.appUsers') }}</a>
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
                {{Form::open(['route'=>['appUsersUpdate',$UserApp->id],'method'=>'POST', 'files' => true])}}

                <div class="form-group row">
                    <label for="username"
                           class="col-sm-2 form-control-label">{!!  __('backend.userName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('username',$UserApp->username, array('placeholder' => '','class' => 'form-control','id'=>'username','required'=>'')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="phone"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPhone') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('phone',$UserApp->phone, array('placeholder' => '','class' => 'form-control','id'=>'phone','required'=>'')) !!}
                    </div>
                </div>
                
                

                <div class="form-group row">
                    <label for="email"
                           class="col-sm-2 form-control-label">{!!  __('backend.userEmail') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::email('email',$UserApp->email, array('placeholder' => '','class' => 'form-control','id'=>'email','required'=>'')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                           class="col-sm-2 form-control-label">{!!  __('backend.userPassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('password','', array('placeholder' => '','class' => 'form-control','id'=>'password')) !!}
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <label for="rePassword"
                           class="col-sm-2 form-control-label">{!!  __('backend.userRePassword') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('rePassword','', array('placeholder' => '','class' => 'form-control','id'=>'rePassword')) !!}
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
                                        <a onclick="document.getElementById('user_photo').style.display='none';document.getElementById('photo_delete').value='1';document.getElementById('undo').style.display='block';"
                                           class="btn btn-sm btn-default">{!!  __('backend.delete') !!}</a>
                                    </div>
                                    <div id="undo" class="col-sm-4 p-a-xs" style="display: none">
                                        <a onclick="document.getElementById('user_photo').style.display='block';document.getElementById('photo_delete').value='0';document.getElementById('undo').style.display='none';">
                                            <i class="material-icons">&#xe166;</i> {!!  __('backend.undoDelete') !!}
                                        </a>
                                    </div>

                                    {!! Form::hidden('photo_delete','0', array('id'=>'photo_delete')) !!}
                                </div>
                            </div>
                        @endif

                        {!! Form::file('image', array('class' => 'form-control','id'=>'image','accept'=>'image/*')) !!}
                        <small>
                            <i class="material-icons">&#xe8fd;</i>
                            {!!  __('backend.imagesTypes') !!}
                        </small>
                    </div>
                </div>
                
                
                
                
                <div class="form-group row">
                    <label for="company_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.userCompanyName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('company_name',$UserApp->company_name, array('placeholder' => '','class' => 'form-control','id'=>'company_name')) !!}
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="office_name"
                           class="col-sm-2 form-control-label">{!!  __('backend.userOfficeName') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('office_name',$UserApp->office_name, array('placeholder' => '','class' => 'form-control','id'=>'office_name')) !!}
                    </div>
                </div>
                
                
                
                
                
                
                <div class="form-group row">
                    <label for="about"
                           class="col-sm-2 form-control-label">{!!  __('backend.userAbout') !!}
                    </label>
                    <div class="col-sm-10">
                        {!! Form::text('about',$UserApp->about, array('placeholder' => '','class' => 'form-control','id'=>'about','required'=>'')) !!}
                    </div>
                </div>
                
                





            {{--    @if(@Auth::user()->permissionsGroup->webmaster_status)
                    <div class="form-group row">
                        <label for="permissions1"
                               class="col-sm-2 form-control-label">{!!  __('backend.Permission') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <select name="permissions_id" id="permissions_id" required
                                        class="form-control c-select">
                                    <option value="">- - {!!  __('backend.selectPermissionsType') !!} - -</option>
                                    @foreach ($Permissions as $Permission)
                                        <option value="{{ $Permission->id  }}" {!! ($Users->permissions_id==$Permission->id) ? "selected='selected'":"" !!}>{{ $Permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>  --}}






                    <div class="form-group row">
                        <label for="verified" class="col-sm-2 form-control-label">{!!  __('backend.status') !!}</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('verified','1',($UserApp->verified==1) ? true : false, array('id' => 'status1','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.active') }}
                                </label>
                                &nbsp; &nbsp;
                                <label class="ui-check ui-check-md">
                                    {!! Form::radio('verified','0',($UserApp->verified==0) ? true : false, array('id' => 'status2','class'=>'has-value')) !!}
                                    <i class="dark-white"></i>
                                    {{ __('backend.notActive') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
     {{--           @else
                    {!! Form::hidden('permissions_id',$Users->permissions_id) !!}
                    {!! Form::hidden('status',$Users->status) !!}

                @endif  --}}


                <div class="form-group row m-t-md">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary m-t"><i class="material-icons">
                                &#xe31b;</i> {!! __('backend.update') !!}</button>
                        <a href="{{route("appUsers")}}"
                           class="btn btn-default m-t"><i class="material-icons">
                                &#xe5cd;</i> {!! __('backend.cancel') !!}</a>
                    </div>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
