@extends('dashboard.layouts.master')
@section('title', __('backend.appREOffices'))
@section('content') 
 
 <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3><i class="material-icons">&#xe02e;</i> {{ __('backend.REOfficeNew') }}</h3>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                    {{ __('backend.settings') }} /
                    <a href="{{ route('appREOffices') }}">{{ __('backend.appREOffices') }}</a> /
                    {{ __('backend.REOfficeNew') }} 
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
                
{{Form::open(['route'=>['appREOfficesStore'],'method'=>'POST', 'files' => true ])}}
    
    
    
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.office_name') }}</label>
        <div class="col-sm-9">
            {!! Form::text('office_name','', array('placeholder' =>'','class' => 'form-control','id'=>'office_name','required'=>'')) !!}
        </div>
    </div>
 
 
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.office_lat') }}</label>
        <div class="col-sm-9">
            {!! Form::number('office_lat','', array('placeholder' =>'','class' => 'form-control','office_lat','required'=>'')) !!}
        </div>
     </div>
     
     
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.office_lng') }}</label>
        <div class="col-sm-9">
            {!! Form::number('office_lng','', array('placeholder' =>'','class' => 'form-control','office_lng','required'=>'')) !!}
        </div>
     </div>
     
     
     
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.sejel') }}</label>
        <div class="col-sm-9">
            {!! Form::number('sejel','', array('placeholder' =>'','class' => 'form-control','sejel','required'=>'')) !!}
        </div>
     </div>
     
     
     
     
    <div class="form-group row">
        <label class="col-sm-3 form-control-label">{{ __('backend.userPhone') }}</label>
        <div class="col-sm-9">
            {!! Form::number('phone_user','', array('placeholder' =>'','class' => 'form-control','id'=>'phone_user','required'=>'')) !!}
        </div>
    </div>
    
    
 
                                
     
                
                            
     
      <div class="form-group row">
           <label for="sejel_image" class="col-sm-3 form-control-label">{!!  __('backend.sejel_image') !!}</label>
                           
          <div class="col-sm-9">
             {!! Form::file('sejel_image', array('class' => 'form-control','id'=>'sejel_image','accept'=>'image/*')) !!}
                <small>
                   <i class="material-icons">&#xe8fd;</i>
                      {!!  __('backend.imagesTypes') !!}
                </small>
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
