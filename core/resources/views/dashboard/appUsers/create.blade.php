@extends('dashboard.layouts.master')
@section('title', __('backend.appUsers'))
@section('content') 
 
 <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ __('backend.userNew') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appUsers') }}">{{ __('backend.appUsers') }}</a> /
                    {{ __('backend.userNew') }} 
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
                
{{Form::open(['route'=>['appUsersStore'],'method'=>'POST', 'files' => true ])}}
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userName') }}</label>
        <div class="col-sm-9">
            {!! Form::text('username','', array('placeholder' =>'','class' => 'form-control','id'=>'username','required'=>'')) !!}
        </div>
    </div>
 
 
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userPhone') }}</label>
        <div class="col-sm-9">
            {!! Form::text('phone','', array('placeholder' =>'','class' => 'form-control','id'=>'phone','required'=>'')) !!}
        </div>
    </div>
    
    
 
                                
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userEmail') }}</label>
        <div class="col-sm-9">
            {!! Form::email('email','', array('placeholder' =>'','class' => 'form-control','id'=>'email','required'=>'')) !!}
        </div>
     </div>
     
     
     
     <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userPassword') }}</label>
        <div class="col-sm-9">
            {!! Form::text('password','', array('placeholder' =>'','class' => 'form-control','id'=>'password','required'=>'')) !!}
        </div>
    </div>
    
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userRePassword') }}</label>
        <div class="col-sm-9">
            {!! Form::text('rePassword','', array('placeholder' =>'','class' => 'form-control','id'=>'rePassword','required'=>'')) !!}
        </div>
    </div>
                            
                            
     
      <div class="form-group row">
           <label for="photo_file" class="col-sm-3 form-control-label">{!!  __('backend.topicPhoto') !!}</label>
                           
          <div class="col-sm-9">
             {!! Form::file('image', array('class' => 'form-control','id'=>'image','accept'=>'image/*')) !!}
                <small>
                   <i class="material-icons">&#xe8fd;</i>
                      {!!  __('backend.imagesTypes') !!}
                </small>
         </div>
    </div>
                                                    
    
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userCompanyName') }}</label>
        <div class="col-sm-9">
            {!! Form::text('company_name','', array('placeholder' =>'','class' => 'form-control','id'=>'company_name','required'=>'')) !!}
        </div>
    </div>   
    
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userOfficeName') }}</label>
        <div class="col-sm-9">
            {!! Form::text('office_name','', array('placeholder' =>'','class' => 'form-control','id'=>'office_name','required'=>'')) !!}
        </div>
    </div> 
    
    
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userAbout') }}</label>
        <div class="col-sm-9">
            {!! Form::textarea('about','', array('placeholder' =>'','class' => 'form-control', 'rows'=>'3', 'id'=>'about','required'=>'')) !!}
        </div>
    </div>
                            
                            
    <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary"><i class="material-icons"> &#xe31b;</i> {!! __('backend.add') !!}</button>
        </div>
    </div>
                            
{{Form::close()}}
 


</div>


</div>
</div>
</div>

@endsection
